<?php

/* File:    databasephp: the central database layer of the CMS
 * Type:    CMS function library
 * Author:  udo.schroeter@gmail.com
 * License: commercially licensed as part of the CMS package
 * Todo:    /
 * Changes: -
 */
global $config, $db_link;
$DB_HOST = $config['db']['host'];
$DB_USER = $config['db']['user'];
$DB_PASS = $config['db']['password'];
$DB_NAME = $config['db']['database'];
$config['db']['usecache'] = false;
$config['db']['metadata'] = $config['db']['prefix'].'sys__metadata';
$config['db']['packextended'] = true;
$GLOBALS['db_link'] = $db_link;

$DBERR = '';

function getTableName($table)
{
  checkTableName($table);
  return(mysql_real_escape_string($table));
}

function DB_KVList($datasets, $table, $vfield)
{
  $result = array();
  $keys = DB_GetKeys($table);
  foreach ($datasets as $item)
  {
    $result[$item[$keys[0]]] = $item[$vfield];
  }
  return($result);
}

function checkTableName(&$table)
{
  global $config;
  $l = strlen($config['db']['prefix']);
  if (substr($table, 0, $l) != $config['db']['prefix'])
    $table = $config['db']['prefix'].$table;
  return($table);
}

function DB_Safe($raw)
{
  return(mysql_real_escape_string($raw));
}

function DB_StripPrefix($tableName)
{
  global $config;
  $preFix = substr($tableName, 0, strlen($config['db']['prefix']));
  if ( $preFix == $config['db']['prefix'] ) 
    $tableName = substr($tableName, strlen($config['db']['prefix']));
  return($tableName); 
}

function getSQLDateTime($unixTimeStamp)
{
  return(date('Y-m-d H:i:s', $unixTimeStamp));
}

// create a comma-separated list of keys in $ds
function MakeNamesList(&$ds)
{
  $result = '';
  if (sizeof($ds) > 0)
    foreach ($ds as $k => $v)
    {
      if ($k!='')
        $result = $result.','.$k;
    }
  return substr($result, 1);
}

// make a name-value list for UPDATE-queries
function MakeValuesList(&$ds)
{
  $result = '';
  global $db_link;
  if (sizeof($ds) > 0)
    foreach ($ds as $k => $v)
    {
      if ($k!='')
        $result = $result.',"'.mysql_real_escape_string($v, $db_link).'"';
    }
  return substr($result,1);
}

function DB_ListItems($tablename, $where = '1', $params = array())
{
  if (!is_array($params)) 
    $params = stringParamsToArray($params);
    
  if (is_array($where))
  {
    $twhere = array();
    foreach ($where as $k => $v)
      $twhere[] = $k.'="'.DB_Safe($v).'"';
    $where = implode(' AND ', $twhere);
    if (trim($where)=='') $where = '1';
  }

  if ($params['limit'] != 0)
    $limitStatement = 'LIMIT '.getDefault($params['offset'], 0).','.$params['limit'];
  else
    $limitStatement = '';

  $result = DB_GetList('SELECT * FROM '.getTableName($tablename).
                       ' WHERE '.$where.
                       ' '.getDefault($params['order']).
                       ' '.$limitStatement);
  
	profile_point('DB_ListItems('.$tablename.')');
	
  return($result);
}

// retrieves a list of fields and their metadata for the give table
function DB_ListFields($tablename)
{
  global $config;
  //DB_ProfileCall('LIST FIELDS '.$tablename);
  checkTableName($tablename);
  include('lib/database-db_listfields.php');
	profile_point('DB_ListFields('.$tablename.')');
  return($fieldDesc);
}

// gets a list of keys for the table
function DB_GetKeys($tablename)
{
  global $config, $db_link;
  checkTableName($tablename);
  if ($config['db']['keys'][$tablename]) return($config['db']['keys'][$tablename]);
  if ($db_link != null)
  {
    if (!isset($config['dbkeytmp'][$tablename]))
    {
      $pk = Array();
      $sql = 'SHOW KEYS FROM `'.$tablename.'`';
      $res = mysql_query($sql, $db_link) or $DBERR = (mysql_error().'{ '.$sql.' }');
      if (trim($DBERR)!='') logError('[DB] '.$DBERR, 'error.sql.log');
      
			while ($row = @mysql_fetch_assoc($res))
      {
        if ($row['Key_name']=='PRIMARY')
          array_push($pk, $row['Column_name']);
      }
      $config['dbkeytmp'][$tablename] = $pk;
      profile_point('DB_GetKeys('.$tablename.')');
    }
    else
    {
      $pk = $config['dbkeytmp'][$tablename];
    }
  }
  return $pk;
}

function DB_PackDataset($table, &$rawds)
{
  $fields = DB_ListFields($table);
  $ext = array();
  foreach($rawds as $k => $v)
  {
    if (!isset($extFieldname)) 
    {
      $f = $k; 
      $extFieldname = CutSegment('_', $f).'_extended';
      if (!isset($fields[$extFieldname])) return;
    }
    if (!isset($fields[$k]))
    {
      $ext[$k] = $v;
      unset($rawds[$k]);
    }
  }
  $rawds[$extFieldname] = serialize($ext);
}

function DB_UnpackDataset($table, &$rawds)
{
  #$fields = DB_ListFields($table);
  foreach($rawds as $k => $v)
  {
    if (!isset($extFieldname)) 
    {
      $extFieldname = CutSegment('_', $k).'_extended';
      if (!isset($rawds[$extFieldname])) return;
    }
  }
  $ext = unserialize($rawds[$extFieldname]);
  if (is_array($ext)) foreach($ext as $k => $v)
  {
    $rawds[$k] = getDefault($rawds[$k], $v); 
  }
}

function DB_SplitDataset(&$ds, $fieldPrefix, $result = array())
{
  foreach($ds as $k => $v)
  {
    if (substr($k, 0, strlen($fieldPrefix)) == $fieldPrefix)
      $result[$k] = $v;
  }
  return($result);
}

function DB_UpdateSearchIndex($tablename, $key, $dataset)
{
  global $config;
  if (!isset($config['db.searchtable'])) return;
  $tablename = DB_StripPrefix($tablename);
  if ($tablename == $config['db.searchtable'] || $tablename == 'meta') return;
  $sds = DB_GetDatasetWQuery('SELECT * FROM '.getTableName($config['db.searchtable']).' 
    WHERE s_ref_table="'.$tablename.'" AND s_ref_row="'.$key.'"');
  // there is a problem here when committing partial datasets
  $sds['s_ref_table'] = $tablename;
  $sds['s_ref_row'] = $key;
  $sds['s_changedon'] = date('Y-m-d H:i:s');
  ob_start();
  print_r($dataset);
  $sds['s_content'] = ob_get_clean();
  DB_UpdateDataset($config['db.searchtable'], $sds);
}

// updates/creates the $dataset in the $tablename
function DB_UpdateDataset($tablename, &$dataset, $keyvalue = null, $keyname = null)
{
  global $db_link, $config;
  //DB_ProfileCall('UPDATE '.$tablename);

  checkTableName($tablename);
  $keynames = DB_GetKeys($tablename);
  if ($keyname == null)
    $keyname = $keynames[0]; 
  
  if ($config['db']['packextended'])
    DB_PackDataset($tablename, $dataset);

  $pureData = $dataset;
  if ($keyvalue != null)
    $pureData[$keyname] = $keyvalue;

  $query='REPLACE INTO '.$tablename.' ('.MakeNamesList($pureData).
      ') VALUES('.MakeValuesList($pureData).');';
  
  mysql_query($query, $db_link) or $DBERR = (mysql_error().'{ '.$query.' }');
  if (trim($DBERR)!='') logError('[DB] '.$DBERR, 'error.sql.log');
  $dataset[$keyname] = getDefault($dataset[$keyname], mysql_insert_id($db_link));
  $pureData[$keyname] = $dataset[$keyname];
  
  if(isset($config['db.searchtable']))
    DB_UpdateSearchIndex($tablename, $pureData[$keyname], $pureData);
    
  profile_point('DB_UpdateDataset('.$tablename.', '.DB_UpdateDataset.')');
  return $pureData[$keyname];
}

// get all the tables in the current database
function DB_GetTables()
{
  global $db_link, $DB_NAME, $config, $DBERR;
  $result = mysql_list_tables($DB_NAME, $db_link);
  $tableList = array();
  while ($row = mysql_fetch_row($result))
      $tableList[] = $row[0];
  sort($tableList);
  return($tableList);
}

function DB_GetDatasetMatch($table, $matchOptions, $fillIfEmpty = true)
{
  $where = array('1');
  if (!is_array($matchOptions))
    $matchOptions = stringParamsToArray($matchOptions);
  foreach($matchOptions as $k => $v)
    $where[] = '('.$k.'="'.mysql_real_escape_string($v).'")';
  $iwhere = implode(' AND ', $where);
	$query = 'SELECT * FROM '.getTableName($table).
    ' WHERE '.$iwhere;
  $resultDS = DB_GetDatasetWQuery($query);
  if ($fillIfEmpty && sizeof($resultDS) == 0)
    foreach($matchOptions as $k => $v)
      $resultDS[$k] = $v;
	profile_point('DB_GetDatasetMatch('.$table.', '.$iwhere.')');
  return($resultDS);
}

// from table $tablename, get dataset with key $keyvalue
function DB_GetDataSet($tablename, $keyvalue, $keyname = null, $options = array())
{
  global $db_link, $config;

  $fields = @$options['fields'];
  $fields = getDefault($fields, '*'); 
  if (!$db_link) return(array());
  if (@$options['nocache'] == true && $config['db']['usecache']) 
  {
    unset($config['dbtmp'][$tablename][$keyname.'.'.$keyvalue]); 
  }
  if (!isset($config['dbtmp'][$tablename][$keyname.'.'.$keyvalue]))
  {
    $result = array();
    if ($keyvalue != '' && $keyvalue != '0')
    {
      //DB_ProfileCall('GET DATASET '.$tablename.' '.$keyvalue);
      checkTableName($tablename);
      if ($keyname == null)
      {
        $keynames = DB_GetKeys($tablename);
        $keyname = $keynames[0];
      }

      $query = 'SELECT '.$fields.' FROM '.$tablename.' WHERE '.$keyname.'="'.
        mysql_escape_string($keyvalue).'";';
      $rs = mysql_query($query, $db_link)
        or $DBERR = mysql_error($db_link).' { Query: "'.$query.'" }';
      
      if ($DBERR != '')
        logError('SQL Error: '.$DBERR, 'error.sql.log');

      if ($line = @mysql_fetch_array($rs, MYSQL_ASSOC))
      {
        $result = $line;
        mysql_free_result($rs);
        if ($config['db']['packextended'])
          DB_UnpackDataset($tablename, $result);
      }
      else
        $result = array();
    }
    if ($config['db']['usecache'])
      $config['dbtmp'][$tablename][$keyname.'.'.$keyvalue] = $result;
  }
  else
  {
    $result = $config['dbtmp'][$tablename][$keyname.'.'.$keyvalue];
  }
	profile_point('DB_GetDataSet('.$tablename.', '.$keyvalue.')');
  return $result;
}

function DB_RemoveDataset($tablename, $keyvalue, $keyname = null)
{
  //DB_ProfileCall('REMOVE DATASET '.$tablename.' '.$keyvalue);
  global $db_link;
  checkTableName($tablename);
  if ($keyname == null)
  {
    $keynames = DB_GetKeys($tablename);
    $keyname = $keynames[0];
  }

  $rs = mysql_query('DELETE FROM '.$tablename.' WHERE '.$keyname.'="'.
  mysql_real_escape_string($keyvalue, $db_link).'";', $db_link)
    or $DBERR = mysql_error($db_link).'{ '.$query.' }';
  if (trim($DBERR)!='') logError('[DB] '.$DBERR, 'error.sql.log');
}

function DB_ParseQueryParams($query, $parameters = null)
{
  if ($parameters != null)
  {
    $pctr = 0;
    $result = '';
    for($a = 0; $a < strlen($query); $a++)
    {
      $c = substr($query, $a, 1);
      if ($c == '?')
      {
        $result .= '"'.mysql_real_escape_string($parameters[$pctr]).'"';
        $pctr++;
      }
      else
        $result .= $c;
    }
  }
  else
    $result = $query;
    
  return($result);
}

// retrieve dataset identified by SQL $query
function DB_GetDataSetWQuery($query, $parameters = null)
{
  global $DBTID, $db_link;

  $query = DB_ParseQueryParams($query, $parameters);

  $rs = mysql_query($query, $db_link)
    or $DBERR = mysql_error($db_link).'{ '.$query.' }';

  if (trim($DBERR)!='') logError('[DB] '.$DBERR, 'error.sql.log');
	
	if ($line = mysql_fetch_array($rs, MYSQL_ASSOC))
  {
    $result = $line;
    mysql_free_result($rs);
  }
  else
  $result = array();
	profile_point('DB_GetDataSetWQuery('.$query.')');
  return $result;
}

// execute a simple update $query
function DB_Update($query, $parameters = null)
{
  global $db_link;
  $query = trim($query);
  $query = DB_ParseQueryParams($query, $parameters);
  if (substr($query, -1, 1) == ';')
    $query = substr($query, 0, -1);
  $rs = mysql_query($query)
    or $DBERR = mysql_error().'{ '.$query.' }';
	profile_point('DB_Update('.$query.')');
  if (trim($DBERR)!='') logError('[DB] '.$DBERR, 'error.sql.log');
}

// get a list of datasets matching the $query
function DB_GetList($query, $parameters = null)
{
  global $config, $db_link;
  $result = array();
  $error = '';

  if ($config['db']['notconfigured'] == true) return(array());

  $query = DB_ParseQueryParams($query, $parameters);

  $lines = mysql_query($query, $db_link) or $error = mysql_error($db_link).'{ '.$query.' }';

  if (trim($error) != '')
  {
    $DBERR = $error;
		#banner($DBERR);
    logError('[DB] '.$error, 'error.sql.log');
  }
  else
  {
    while ($line = mysql_fetch_array($lines, MYSQL_ASSOC))
    {
      if (isset($keyByField))
        $result[$line[$keyByField]] = $line;
      else
        $result[] = $line;
    }
    mysql_free_result($lines);
  }
	profile_point('DB_GetList('.substr($query, 0, 40).'...)');
  return $result;
}

// ***************************************************************************
// include settings from database
// ***************************************************************************

profile_point('DB_Init(parse)');
$db_link = @mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or
  $DBERR = 'The database connection to server '.$DB_USER.'@'.$DB_HOST.' could not be established (code: '.@mysql_error($db_link).')';

@mysql_select_db($DB_NAME, $db_link) or
  $DBERR = 'The database connection to database '.$DB_NAME.' on '.$DB_USER.'@'.$DB_HOST.' could not be established. (code: '.@mysql_error($db_link).')';

mysql_query("SET NAMES 'utf8'");
profile_point('DB_Init(mysql_connect)');

if ($DBERR != '')
{
  $errorMessage = $DBERR;
  $config['db']['notconfigured'] = true;
  if (@$_REQUEST['m'] != 'setup') $banner = $errorMessage;
  logError('[DB] '.$DBERR, 'error.sql.log');
  die();
}
else
{
  $config['db']['notconfigured'] = false;
  $config['db']['connected'] = true;
}

?>
