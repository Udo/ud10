<?php
/**
 * Author: udo.schroeter@gmail.com
 * Project: Hubbub2
 * Description: some general convenience functions and wrappers
 */

/* inits the profiler that allows performance measurement */
error_reporting(E_ALL ^ E_NOTICE);
// init the profiler timestamp
$GLOBALS['profiler_last'] = getDefault($GLOBALS['profiler_start'], microtime());

/* retrieve a config value (don't use $GLOBALS['config'] directly if possible) */
function cfg($name, $default = null, $set = false)
{
	$vr = &$GLOBALS['config'];
	foreach(explode('/', $name) as $ni) 
	  if(is_array($vr)) $vr = &$vr[$ni]; else $vr = '';
	if($set)
	  $vr = $default; 
	return(getDefault($vr, $default));
}

function parseModuleHeader(&$result)
{
  $mode = 'header';
  foreach($result['raw'] as $line)
  {
    $line = trim($line);
    if($line == '' && $mode == 'header') 
    {
      $mode = 'text';
    }
    else if($mode == 'header')
    {
      $k = cutSegment('=', $line);
      $result['header'][$k] = $line;
    }
    else
    { 
      if(substr($line, -1) == '+')
      {
        // this is a mixin-list
        $line = substr($line, 0, -1);
        // clear the line of heading designation if necessary
        $cleanLine = $line;
        $level = 0;
        while(substr($cleanLine, 0, 1) == '#') 
        {
          $level++;
          $cleanLine = substr($cleanLine, 1);
        }
        $result['header']['mixin'][$line] = array('cap' => $cleanLine, 'idx' => sizeof($result['text']), 'level' => $level);
      }
      $result['text'][] = $line;
    }
  }
  return($result);
}

function getModuleFile($fn)
{
  $result = array();
  $result['raw'] = @file($fn);
  if(!is_array($result['raw'])) $result['raw'] = array();
  parseModuleHeader($result);
  return($result);
}

function file_list($dir)
{
  $result = array();
  if(is_dir($dir))
  {
    if($handle = opendir($dir))
    {
      while(($file = readdir($handle)) !== false)
      {
        if(substr($file, 0, 1)!='.' && $file != "Thumbs.db"/*pesky windows, images..*/)
        {
          $result[$dir.$file] = $file;
        }
      }
      closedir($handle);
    }
  }
  asort($result);
  return($result);
}

function table($t, $par = array(), $opt = array())
{
  if($par != null && !is_array($par)) $par = explode(',', $par);
  if(!$opt['nosort']) ksort($t);
  ?><table cellpadding="3" cellspacing="1" class="tbl"><?
  
  ob_start();
  foreach($t as $k => $row)
  {
    $rowctr++;
    ?><tr <?= $rowctr % 2 == 0 ? '' : 'class="odd"' ?>>
    
    <td valign="top"><?= htmlspecialchars($k) ?></td><?
    
    $colctr = -1;
    foreach($row as $ck => $cv)
    {
      $colctr++;
      if($rowctr == 1) $hdr[] = $ck;
      $colstyle = '';
      if($par[$colctr]) $colstyle = 'text-align: '.$par[$colctr];
      ?><td valign="top" style="<?= $colstyle ?>"><?= htmlspecialchars($cv) ?></td><?
    }
    
    ?></tr><? 
  }
  $body = ob_get_clean();
  
  ?><tr>
    <th></th><?
    $colctr = -1;
    foreach($hdr as $h) 
    {
      $colctr++;
      $colstyle = '';
      if($par[$colctr]) $colstyle = 'text-align: '.$par[$colctr];
      print('<th style="'.$colstyle.'">'.$h.'</th>');
    }
    ?>
  </tr><?
  
  print($body);
  
  ?></table><br/><?
}

/* returns an object from the global context (such as an instantiated model) */
function object($name, $setObject = null)
{
  if(is_object($setObject)) $GLOBALS['obj'][$name] = $setObject;
	return($GLOBALS['obj'][$name]);
}

/* connect with a memcache server if enabled */
function cache_connect()
{
  if(!cfg('memcache/enabled')) return(false);
  if(object('memcache')) return(true);
  profile_point('cache_connect()');
  // parsing the access URL
  $mcUrl = explode(':', cfg('memcache/server'));
  // connect to server  
  $GLOBALS['errorhandler_ignore'] = true;
  $mc = @memcache_pconnect($mcUrl[0], $mcUrl[1]+0);
  $GLOBALS['errorhandler_ignore'] = false;
  // if this didn't work out:
  if($mc === false)
  {
    $GLOBALS['config']['memcache']['enabled'] = false;
    logError('memcache: could not connect to server '.cfg('memcache/server'));
    return(false);
  }  
  object('memcache', $mc);  
  return(true);
}

function cache_delete($key)
{
  if(!cache_connect()) return(false);
  return(memcache_delete(object('memcache'), cfg('service/server').'/'.$key));
}

function cache_get($key)
{
  if(!cache_connect()) return(false);
  return(memcache_get(object('memcache'), cfg('service/server').'/'.$key));
}

function cache_set($key, $value)
{
  if(!cache_connect()) return(false);
  $key = cfg('service/server').'/'.$key;
  $op = memcache_replace(object('memcache'), $key, $value, MEMCACHE_COMPRESSED, MEMCACHE_TTL);
  if($op == false)
    memcache_add(object('memcache'), $key, $value, MEMCACHE_COMPRESSED, MEMCACHE_TTL);
}

function cache_region($key, $generateFunction, $ignoreCache = false)
{
  if($ignoreCache)
  {
    $generateFunction();
    return; 
  }
  $out = cache_get($key);
  if($out === false)
  {
    ob_start();
    $generateFunction();
    $out = ob_get_clean();
    cache_set($key, $out);    
  }
  print($out);
}

function cache_data($key, $generateFunction)
{
  $result = cache_get($key);
  if($result === false)
  {
    $result = $generateFunction();
    cache_set($key, json_encode($result));    
  }
  else
  {
    $result = json_decode($result, true);
  }
  return($result);
}

/* the difference between memoize() and cache_data() is
   that memoize() stores values for use inside a single
   request only whereas cache_data() caches across requests
   and across users */
function memoize($key, $generateFunction)
{
  $result = $GLOBALS['memoize'][$key];
  if(!isset($result))
  {
    $result = $generateFunction();
    $GLOBALS['memoize'][$key] = $result;    
  }
  return($result);
}

function memoize_reset($prefix = null)
{
  $GLOBALS['memoize'] = array();
}

function l10n($s, $silent = false)
{
  $lout = $GLOBALS['l10n'][$s];
  if(isset($lout)) 
    return($lout);
  else if($silent === true)
    return('');
  else
    return('['.$s.']');
}

function l10n_load($filename_base)
{
  if(isset($GLOBALS['l10n_files'][$filename_base])) return;
  $lang_try = array();
  $usr = object('user');
  if($usr != null) $lang = $usr->lang; 
  if($lang != '') $lang_try[] = $lang;
  $lang_try[] = 'en';
  foreach($lang_try as $ls)
  {
    $lang_file = $filename_base.'.'.$ls.'.cfg';
    if(file_exists($lang_file))
    {
	    foreach(stringsToStringlist(file($lang_file)) as $k => $v) 
	      $GLOBALS['l10n'][$k] = $v;
	    $GLOBALS['l10n_files'][$filename_base] = $lang_file;
    }
  }
}

function randomHashId()
{
  return(h2_make_uid());
}

/* makes a commented profiler entry */ 
function profile_point($text)
{
  $thistime = microtime();
  $GLOBALS['profiler_log'][] = profiler_microtime_diff($thistime, $GLOBALS['profiler_start']).' | '.profiler_microtime_diff($thistime, $GLOBALS['profiler_last']).' msec | '.
    ceil(memory_get_usage()/1024).' kB | '.$text;
  $GLOBALS['profiler_last'] = $thistime;
}

/* subtracts to profiler timestamps and returns miliseconds */
function profiler_microtime_diff(&$b, &$a)
{
  list($a_dec, $a_sec) = explode(" ", $a);
  list($b_dec, $b_sec) = explode(" ", $b);
  return number_format(1000*($b_sec - $a_sec + $b_dec - $a_dec), 3);
}

/* this should be part of PHP actually */
function inStr($haystack, $needle)
{
  return(!(stripos(trim($haystack), trim($needle)) === false));
}

function strStartsWith($haystack, $needle)
{
  return(substr(strtolower($haystack), 0, strlen($needle)) == strtolower($needle));
}

function strEndsWith($haystack, $needle)
{
  return(substr(strtolower($haystack), -strlen($needle)) == strtolower($needle));
}

/* open new file (overwrite if it already exists) */
function newFile($filename, $content)
{
  if(file_exists($filename)) unlink($filename);
  WriteToFile($filename, $content); 
}

/* append any string to the given file */
function WriteToFile($filename, $content)
{
  $open = fopen($filename, 'a+');
  fwrite($open, $content);
  fclose($open);
}

// standard logging function (please log only to the log/ folder)
// - error logs should begin with the prefix "err."
// - warning logs should begin with the prefix "warn."
// - notice logs should begin with the prefix "notice."
function logToFile($filename, $content)
{
  global $profiler_report, $profiler_time_start, $profiler_last;
  if (!is_array($content)) $content = array('text' => $content);

	$uri = $_SERVER['REQUEST_URI'];
	if(stristr($uri, 'password') != '') $uri = '***';

  $content['remote'] = $_SERVER['REMOTE_ADDR'];
  $content['host'] = $_SERVER['HTTP_HOST'];
  $content['uri'] = $uri;
  $content['session'] = $_SESSION['uid'].'/'.session_id();
  $content['time'] = gmdate('Y-m-d H:i:s');
  $content['exec'] = profiler_microtime_diff(microtime(), $GLOBALS['profiler_start']).'ms';

  @WriteToFile($filename,
    str_replace('\/', '/', json_encode($content))."\r\n\r\n");
}	

/* logs an error, duh */
function logError($msg, $msg2 = '')
{
  if($GLOBALS['nolog']) return;
  $bt = debug_backtrace();
  unset($bt[0]);
  unset($bt[0]);
  $bts['error'] = $msg.' '.$msg2;
  foreach($bt as $s)
    $bts['trace'][] = $s['file'].' line '.$s['line'].' '.$s['function'].'('.(is_string($s['args'][0]) ? '"'.$s['args'][0].'"' : '['.gettype($s['args'][0]).']').')';
  
  logToFile('log/error.log', $bts);
}

/* takes a query string or request_uri and parses it for parameters */
function interpretQueryString($qs)
{
  $GLOBALS['config']['service']['url_rewrite'] = true;
  $uri = parse_url('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
  $path = '';
  if($uri['query'] != '') 
  {
    parse_str($uri['query'], $_REQUEST_new);
    $_REQUEST = array_merge($_REQUEST, $_REQUEST_new);
    $firstPart = CutSegment('&', $uri['query']);
    if(!$GLOBALS['config']['service']['url_rewrite'] && !inStr($firstPart, '=')) $path = $firstPart;
  }
  if($GLOBALS['config']['service']['url_rewrite'])
  {
    $_REQUEST['rewrite'] = 'true';
    $path = substr($uri['path'], 1);  
  }
  else
    $_REQUEST['rewrite'] = 'false';
  
  $call = explode(URL_CA_SEPARATOR, str_replace('/', '', $path));
  if(!array_search($path, array('robots.txt', 'favicon.ico')) === false) return;
  foreach(explode('/', $call[0]) as $ctrPart)
    if(trim($ctrPart) != '') $controllerPart = $ctrPart;

  $_REQUEST['controller'] = getDefault($controllerPart, cfg('service/defaultcontroller'));
  unset($call[0]);
  $_REQUEST['action'] = getDefault(implode(URL_CA_SEPARATOR, $call), cfg('service/defaultaction'));
  
}

function getCurrentProtocol()
{
  return('http'); 
}

/* use this to make a hyperlink that calls a controller with an action */
function hyperlink($caption, $controllerAction, $params = array())
{
  $controller = CutSegment('/', $controllerAction);
  return('<a href="'.actionUrl($controllerAction, $controller, $params).'">'.htmlspecialchars(getDefault(l10n($caption, true), $caption)).'</a>'); 
}

/* makes an URL calling a specific controller with a specific action */
function actionUrl($action = '', $controller = '', $params = array(), $fullUrl = false)
{ 
  $p = '';
  $controller = getDefault($controller, $_REQUEST['controller']);
  if(isset($GLOBALS['subcontrollers'][$controller]))
    $controller = $GLOBALS['subcontrollers'][$controller].URL_CA_SEPARATOR.$controller;
  $action = getDefault($action, $_REQUEST['action']);
  if (!is_array($params)) $params = stringParamsToArray($params);
  if(sizeof($params) > 0) 
  {
    // prevent cookies from appearing in the server log by accident
    foreach(array('session-key', session_id()) as $k) 
      if(isset($params[$k])) unset($params[$k]);
    $pl = http_build_query($params);
    $p = '?'.$pl;
    $pn = '&'.$pl;
  }   
  if($fullUrl)
  {
    $base = cfg('service.base');
    if(trim($base) == '') $base = cfg('service/server');
    if(substr($base, -1) != '/') $base .= '/';
  }
  if(cfg('service/url_rewrite'))
  {
    $url = $controller.($action == 'index' ? '' : URL_CA_SEPARATOR.$action).$p; 
    return($base.$url);
  }
  else 
  {
    $url = '?'.$controller.($action == 'index' ? '' : URL_CA_SEPARATOR.$action).$pn; 
    return(getDefault($base, './').$url);
  }  
}

/* internal function needed to parse parameters in the form of "p1=bla,p2=blub" into a proper array */
function stringParamsToArray($paramStr)
{
  $result = array();
  foreach(explode(',', $paramStr) as $line)
  {
    $k = CutSegment('=', $line);
    $result[$k] = $line;	
  }
  return($result);
}

function filterArray($array, $keys)
{
  $result = array();
  foreach($keys as $k) $result[$k] = $array[$k];
  return($result); 
}

function defaultArray()
{
	foreach(func_get_args() as $a)
		if(is_array($a)) return($a);
	return(array());
}

// legacy
function getDefault()
{
	foreach(func_get_args() as $a)
		if($a != null && $a != '') return($a);
	return('');
}

function first()
{
	foreach(func_get_args() as $a)
		if($a != null && $a != '') return($a);
	return('');
}

function varSet()
{
	foreach(func_get_args() as $a)
		if($a == null) return(false);
	return(true);
}

/* cut $cake at the first occurence of $segdiv, returns the slice 
   if $segdiv is an array, it will use the first occurence that matches any of its entries */
function CutSegmentEx($segdiv, &$cake, &$found, $params = array())
{
  if(!is_array($segdiv)) $segdiv = array($segdiv);
  $p = false;
  foreach($segdiv as $si)
  {  
    $pi = strpos($cake, $si);
    if($pi !== false && ($pi < $p || $p === false)) 
    {
      $p = $pi;
      $pfirst = $p;
      $slen = strlen($si);
    }
  }
  if ($p === false)
  {
    $result = $cake;
    $cake = '';
    $found = false;
  }
  else
  {
    if($params['full']) $pfirst += $slen;
    $result = substr($cake, 0, $pfirst);
    $cake = substr($cake, $p + $slen);
    $found = true;
  }
  return $result;
}

/* like CutSegmentEx(), but doesn't carry the $found result flag */
function CutSegment($segdiv, &$cake, $params = array())
{
  return(CutSegmentEx($segdiv, $cake, $found, $params));
}

function textToArray($text)
{
  $lines = explode(chr(13), $text);
  return(stringsToStringlist($lines)); 
}

function arrayToText($array)
{
  return(implode(chr(13), stringlistToStrings($array))); 
}

/* converts a list of config strings into an associative array */
function stringsToStringlist($stringArray)
{
  $result = array();  
  if (is_array($stringArray))
    foreach ($stringArray as $line)
    {
      $key = trim(CutSegment('=', $line));
      if($key == '') 
        $result[$lastKey] .= ($line);
      else if(substr($key, -1) == '+')
        $result[substr($key, 0, -1)] .= ($line);
      else
      {
        $result[$key] = ($line);
        $lastKey = $key;
      }
    }
  return($result);
}


/* converts an assoc array into a list of config strings */
function stringListToStrings($stringList)
{
  $result = array();
  foreach ($stringList as $k => $v)
  {
    if (trim($v) != '' && $k != '')
      $result[] = $k.'='.trim($v);
  }
  return($result);
}

/* issues a HTTP redirect immediately */
function redirect($tourl)
{
  header('X-Redirect-From: '.$_SERVER['REQUEST_URI']);
	header('Location: '.$tourl);
	die();
} 

function file_get_fromurl($url, $post = array(), $timeout = 2)
{
  $fle = cqrequest($url, $post, $timeout);
  return($fle['body']);	
}

function http_parse_request_ex($result, $headerMode = true)
{
  $resHeaders = array();
  $resBody = array();
  
  foreach(explode("\n", $result) as $line)
  {
    if($headerMode)
    {
      if(strStartsWith($line, 'HTTP/'))
      {
        $httpInfoRecord = explode(' ', trim($line));
        if($httpInfoRecord[1] == '100') $ignoreUntilHTTP = true;
        else 
        {
          $ignoreUntilHTTP = false;
          $resHeaders['code'] = $httpInfoRecord[1];
          $resHeaders['HTTP'] = $line;
        }
      }
      else if(trim($line) == '')
      {
        if(!$ignoreUntilHTTP) $headerMode = false;
      }
      else 
      {
        $hdr_key = trim(CutSegment(':', $line));
        $resHeaders[strtolower($hdr_key)] = trim($line); 
      }
    }
    else
    {
      $resBody[] = $line; 
    }    
  }

  $body = trim(implode("\n", $resBody));
  $data = json_decode($body, true);

  return(array(
    'result' => $resHeaders['code'],
    'headers' => $resHeaders,
    'data' => $data,
    'body' => $body));
}

/* makes a GET or POST request to an URL */
function cqrequest($url, $post = array(), $timeout = 2, $headerMode = true, $onlyHeaders = false)
{
  $ch = curl_init();
  $resheaders = array();
  $resbody = array();
  curl_setopt($ch, CURLOPT_URL, $url);
  if(sizeof($post)>0) 
  {
    $onlyHeader = false;
    curl_setopt($ch, CURLOPT_POST, 1); 
  }
  if($onlyHeaders) curl_setopt($ch, CURLOPT_NOBODY, 1);
  
  // this is a workaround for a parameter bug/feature that prevents params starting with an @ from working correctly
  foreach($post as $k => $v) if(substr($v, 0, 1) == '@') $post[$k] = '\\'.$v;

  if(sizeof($post)>0) curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  if($headerMode) curl_setopt($ch, CURLOPT_HEADER, 1);  
  curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  $result = str_replace("\r", '', curl_exec($ch));
  curl_close($ch);
  return(http_parse_request_ex($result));
}

function _cqget_write($handle, $data) {
  $GLOBALS['cqgetf'] .= $data;
  if (strlen($GLOBALS['cqgetf']) > $GLOBALS['cqgetf_limit']) 
  {
    $GLOBALS['cqgetf_error'] = 'file too large';
    unset($GLOBALS['cqgetf']);
    return 0;
  }
  else
    return strlen($data);
}

function cqget($url, $limitSize = 2097152) 
{    
  $GLOBALS['cqgetf_limit'] = $limitSize;
  $GLOBALS['cqgetf'] = '';
  $options = array();
  $defaults = array( 
    CURLOPT_URL => $url, 
    CURLOPT_HEADER => 0, 
    CURLOPT_RETURNTRANSFER => TRUE, 
    CURLOPT_TIMEOUT => 4,
    CURLOPT_WRITEFUNCTION => '_cqget_write',
  ); 
  
  $ch = curl_init(); 
  curl_setopt_array($ch, ($options + $defaults)); 
  curl_exec($ch);
  curl_close($ch); 
  return($GLOBALS['cqgetf']); 
} 

function cqmrequest($rq_array, $post = array(), $timeout = 1, $headerMode = true, $onlyHeaders = false)
{
  $rq = array();
  $content = array();
  $active = null;
  $idx = 0;
  $multi_handler = curl_multi_init();
  
  // configure each request
  foreach($rq_array as $rparam) if(trim($rparam['url']) != '')
  {
    $idx++;
    $channel = curl_init();
    curl_setopt($channel, CURLOPT_URL, $rparam['url']);
    $combinedParams = $post;
    if(is_array($rparam['params'])) $combinedParams = array_merge($rparam['params'], $post);
    if(sizeof($combinedParams)>0) 
    {
      curl_setopt($channel, CURLOPT_POST, 1); 
      curl_setopt($channel, CURLOPT_POSTFIELDS, $combinedParams);
    }
    curl_setopt($channel, CURLOPT_HEADER, 1); 
    curl_setopt($channel, CURLOPT_TIMEOUT, $timeout); 
    curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
    curl_multi_add_handle($multi_handler, $channel);
    $rq[$idx] = array($channel, $rparam);
  }
  
  if(sizeof($rq) == 0) return(array());
  
  // execute
  do {
      $mrc = curl_multi_exec($multi_handler, $active);
  } while ($mrc == CURLM_CALL_MULTI_PERFORM);
  
  // wait for return
  while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($multi_handler) != -1) {
        do {
            $mrc = curl_multi_exec($multi_handler, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
  }
  
  // cleanup
  foreach($rq as $idx => $rparam)
  {
    $result = http_parse_request_ex(curl_multi_getcontent($rparam[0]));
    $result['param'] = $rparam[1];
    $content[] = $result;
    curl_multi_remove_handle($multi_handler, $channel);
  }
  
  curl_multi_close($multi_handler);
  
  return($content);  
}

/* makes a Unix timestamp human-friendly, web-trendy and supercool */
function ageToString($unixDate, $new = 'new', $ago = 'ago')
{
  if($unixDate == 0) return('-');
  $result = '';
  $oneMinute = 60;
  $oneHour = $oneMinute*60;
  $oneDay = $oneHour*24;
    $difference = time() - $unixDate;
  if ($difference < $oneMinute)
    $result = $new;
  else if ($difference < $oneHour)
    $result = round($difference/$oneMinute).' min '.$ago;
  else if ($difference < $oneDay)
    $result = floor($difference/$oneHour).' h '.$ago;
  else if ($difference < $oneDay*5)
    $result = gmdate(getDefault(cfg('service/dateformat-week'), 'l · H:i'), $unixDate);
  else if ($difference < $oneDay*365)
    $result = gmdate(getDefault(cfg('service/dateformat-year'), 'M dS · H:i'), $unixDate);
  else
    $result = date(getDefault(cfg('service/dateformat'), 'd. M Y · H:i'), $unixDate);
  return($result);
}

/* makes an input totally safe by only allowing a-z, 0-9, and underscore (might not work correctly) */
function safeName($raw)
{
	return(preg_replace('/[^a-z|0-9|\_|\.]*/', '', strtolower($raw)));
}

/* version of strip_tags that kills attributes, since the PHP version is horribly unsafe */
function strip_tags_attributes($string,$allowtags=NULL,$allowattributes=NULL)
{
  $string = strip_tags($string,$allowtags);
  if (!is_null($allowattributes)) {
      if(!is_array($allowattributes))
          $allowattributes = explode(",",$allowattributes);
      if(is_array($allowattributes))
          $allowattributes = implode(")(?<!",$allowattributes);
      if (strlen($allowattributes) > 0)
          $allowattributes = "(?<!".$allowattributes.")";
      $string = preg_replace_callback("/<[^>]*>/i",create_function(
          '$matches',
          'return preg_replace("/ [^ =]*'.$allowattributes.'=(\"[^\"]*\"|\'[^\']*\')/i", "", $matches[0]);'   
      ),$string);
  }
  return $string;
} 
 
function extract_tags_prepare($raw)
{
  $GLOBALS['matches'] = array();
  $GLOBALS['matchprefix'] = h2_make_uid();
	$in = array(
    '`((?:\#)\S+[[:alnum:]]/?)`si',
    );
  return preg_replace_callback($in, function($matches) {
    $GLOBALS['matchcount']++;
    $matchKey = $GLOBALS['matchprefix'].'-'.$GLOBALS['matchcount'];
    $GLOBALS['matches'][$matchKey] = substr($matches[0], 1);
    return($matchKey);
    }, $raw);   
}

function getTagLink($postKey, $tagName)
{
  return('<a onclick="H2HandleTag($(this), '.$postKey.', \''.$tagName.'\', \''.getTagClass($tagName).'\');" ><span class="ptaglink">#</span>'.$tagName.'</a>'); 
}

function extract_tags_execute($url, $postKey)
{
  foreach($GLOBALS['matches'] as $k => $match)
  {
    $match = htmlspecialchars($match);
    $url = str_replace($k, getTagLink($postKey, $match), $url);
  }
  return($url); 
}

function getTagClass($tagName)
{
  return('tc_'.substr(md5($tagName), 0, 8)); 
}
 
// FIXME: horrible...
function make_clickable_prepare($url) {
  $GLOBALS['matches'] = array();
  $GLOBALS['matchprefix'] = h2_make_uid();
	$in = array(
    '`((?:https?|ftp)://\S+[[:alnum:]]/?)`si',
    '`((?<!//)(www\.\S+[[:alnum:]]/?))`si',
    );
  return preg_replace_callback($in, function($matches) {
    $GLOBALS['matchcount']++;
    $matchKey = $GLOBALS['matchprefix'].'-'.$GLOBALS['matchcount'];
    $GLOBALS['matches'][$matchKey] = $matches[0];
    return($matchKey);
    }, $url); 
}

function make_clickable_execute($url)
{
  foreach($GLOBALS['matches'] as $k => $match)
  {
    $p = parse_url($match);
    $u = $p['host'].$p['path'].($p['query'] ? '?'.$p['query'] : '');
    $v = getDefault($p['scheme'], 'http').'://'.$p['host'].($p['path'].$p['query'] != '/' ? $p['path'] : '').($p['query'] ? '?'.$p['query'] : '');
    $url = str_replace($k, '<a href="'.$v.'" rel="nofollow" target="_blank">'.$u.'</a>', $url);
  }
  return($url); 
}

?>
