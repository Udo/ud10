<?

  header('content-type: text/html; charset=utf-8');
  profile_point('- page start');

  $menu = array(
    '/' => "Udo's D10".' <img height="32" align="absmiddle" style="margin-bottom:-4px;margin-top:-4px;" src="/theme/n3-d10.png"/>',
    '/rules' => 'Basic Rules',
    '/module' => 'Modules',
    #'/packages' => 'Packages',
    #'/about' => 'About',  
    );

  foreach($menu as $k => $v) {
    if(substr($k, 1) == $_REQUEST['controller']) 
    {
      $GLOBALS['pagetitle'] = $v;
      $m[] = '<a class="active" href="'.$k.'">'.$v.'</a>';
    }
    else
      $m[] = '<a href="'.$k.'">'.$v.'</a>';
  } 
  
  if($GLOBALS['submenu']) foreach($GLOBALS['submenu'] as $k => $v) {
    if($k == $GLOBALS['submenu_active']) 
    {
      $GLOBALS['pagetitle'] .= ': '.$v;  
      $sm[] = '<a class="active" href="'.$k.'">'.$v.'</a>';
    }
    else
      $sm[] = '<a href="'.$k.'">'.$v.'</a>';
  } 

  $ptitle = htmlspecialchars(getDefault($GLOBALS['pagetitle'], 'UD10'));
  
?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
  <head>
    <title><?= $ptitle ?> | UD10</title>
    <link type="text/css" rel="stylesheet" href="/theme/default.css"/> 
    <link rel="icon" type="image/png" href="/theme/n3-d10.png">
  </head>
  <body>
  
    <div id="navwrap"><nav>
    
      <?= implode(' &middot; ', $m) ?>
    
      <? if($sm) { 
        ?><div id="submenu"><?= implode(' &middot; ', $sm) ?></div>
      <? } ?>
    
    </nav></div>
  
    <div id="content">
    <!--<h1 class="navh1"><?= $ptitle ?></h1>-->
    <?= $content ?>
    </div>
    
    <div id="footer">
      
       
      
        <span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/Text" property="dct:title" rel="dct:type">UD10</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://ud10.org" property="cc:attributionName" rel="cc:attributionURL">Udo Schroeter</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
        
        <br/>
        
         <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" align="absmiddle"/></a>
      
    </div>
  
  <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-426761-17']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>
  </body>
</html>