<?

  $profiler_time_start = microtime();
	$GLOBALS['app.basepath'] = dirname(__FILE__).'/';
  $config = array();
  define('URL_CA_SEPARATOR', '-');

  if(strpos(PHP_OS, "WIN") !== false) 
    $config['os.path.separator'] = ';';
  else
    $config['os.path.separator'] = ':';
    
  error_reporting(E_ALL ^ E_NOTICE);
  $config['context'] = array('sys/', 'custom/');
  $searchPath = array('.', '../', 'sys/', 'custom/');
  foreach($_REQUEST as $k => $v)
    if(substr(str_replace('.', '', $v), 0, 8) == '22250738') die('!float overflow!');

  ini_set('include_path', implode($config['os.path.separator'], $searchPath));
  ini_set('session.cookie_httponly', 1);
  ini_set('error_log', 'log/error.php.log');
  ini_set('log_errors', true);
  $GLOBALS['templatename'] = 'page'; 

  ob_start('ob_gzhandler');
  ob_start();
  
  include_once($GLOBALS['app.basepath'].'lib/genlib.php');
  if (substr($_SERVER['REQUEST_URI'], 0, 1) == '/')
  {
    interpretQueryString($_SERVER['REQUEST_URI']);
  }
  
  foreach ($_REQUEST as $k => $v)
    $_REQUEST[$k] = stripslashes($v);
    
	$_REQUEST['controller'] = getDefault($_REQUEST['controller'], 'index');
			
  $startupErrors = ob_get_clean();  
  ob_start();
	$pageFile = 'pages/'.$_REQUEST['controller'].'.php';
	if(file_exists($pageFile))
	{
    include($pageFile);
	}
	else
	{
	  $pageTitle = 'Page not found: '.$_REQUEST['controller'];
		header("HTTP/1.0 404 Not Found");
		print('coming soon...');
	}
	$content = ob_get_clean();
	
	if($GLOBALS['templatename'] != 'blank')
	  include('theme/'.$GLOBALS['templatename'].'.php');
	else
	  print($content);

  ob_end_flush();
  