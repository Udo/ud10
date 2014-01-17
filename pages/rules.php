<?

  $sub = getDefault($_REQUEST['action'], 'rolls');
  $GLOBALS['submenu_active'] = '/rules-'.$sub;
  
  $GLOBALS['submenu'] = array(
    '/rules-rolls' => 'Rolls',
    '/rules-attributes' => 'Attributes',
    '/rules-health' => 'Health',
    '/rules-skills' => 'Skills',
    '/rules-char' => 'Character Creation',
    '/rules-combat' => 'Combat',
    '/rules-equipment' => 'Equipment',
    '/rules-xp' => 'XP and Progression',
    );
    
  $GLOBALS['pretitle'] = ('<div class="csep"></div>');
    
  $sp = 'pages/rules-'.$sub.'.php';
  if(file_exists($sp)) include($sp); else print('coming soon...');

?>