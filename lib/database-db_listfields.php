<?
  /* author: udo.schroeter@gmail.com
   * license: LGPL
   * description: list fields in a table
   */   

  $fieldDesc = array();
  
  $metaFields = array();#DB_GetFieldMetaInfo($tablename);
     
  $result = mysql_query("SELECT * FROM ".$tablename." LIMIT 1");
  $fields = @mysql_num_fields($result);
  $table = @mysql_field_table($result, 0);
  for ($i=0; $i < $fields; $i++)
  {
    $fieldName = mysql_field_name($result, $i);
    if (!$clearXdata || ($fieldName!='_xdata' && substr($fieldName, 0, 1)!='_'))
    {
      @$fullInfo = array(
            'type' => mysql_field_type($result, $i),
            'name' => $fieldName,
            'length' => mysql_field_len($result, $i),
            'flags' => explode(' ', mysql_field_flags($result, $i)),
            'caption' => getDefault($metaFields[$fieldName.'.caption'], $fieldName),
            'subtype' => $metaFields[$fieldName.'.subtype'],
            'ref' => getDefault($metaFields[$fieldName.'.ref']),
            );
      
      if ($withKeys)
        $fieldDesc[$fieldName] = $fullInfo; 
      else if ($simple)
        $fieldDesc[$fieldName] = $fieldName;
      else
        $fieldDesc[$fieldName] = $fullInfo;
    }
  }
  @mysql_free_result($result);
?>
