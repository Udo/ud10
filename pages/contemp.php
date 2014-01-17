<?

  $area = 'contemp';

  $sub = getDefault($_REQUEST['action'], 'index');
  $GLOBALS['submenu_active'] = '/'.$area.'-'.$sub;
  
  $GLOBALS['submenu'] = array(
    '/'.$area.'-index' => 'About',
    );
    
  $GLOBALS['pretitle'] = ('<div class="csep"></div>');
    
  $sp = 'pages/'.$area.'-'.$sub.'.php';
  if(file_exists($sp)) include($sp); else print('coming soon...');

?>