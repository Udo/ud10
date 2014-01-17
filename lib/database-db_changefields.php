<?

  $fieldInfo = DB_ListFields($tableName, false, false, true, true);
  $metaInfo = DB_GetFieldMetaInfo($tableName);

  foreach ($fieldDesc as $fieldName => $fieldProperties)
  {
    $metaInfo[$fieldName] = $fieldProperties;
  }
   
  DB_SetFieldMetaInfo($tableName, $metaInfo);    
        
?>
