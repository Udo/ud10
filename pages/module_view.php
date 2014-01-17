<?

include('lib/markdown.php');

$pathInfo = pathInfo($_REQUEST['m'].'.txt');

$GLOBALS['submenu'] = array(
  '/module' => '^ Module Directory',
  );

$modFile = 'module-data/'.($_REQUEST['m']).'.txt';
$modSeg = explode('/', $_REQUEST['m']);
array_pop($modSeg);
$basePath = implode('/', $modSeg);
$module = getModuleFile($modFile);

$GLOBALS['pagetitle'] = first($module['header']['name'], $_REQUEST['m']);

$otherModules = array();
foreach(file_list('module-data/'.$basePath.'/') as $omf)
{
  $omfb = CutSegment('.', $omf);
  if($omf == 'txt')
    $otherModules[] = '<a href="/module_view?m='.($basePath).'/'.urlencode($omfb).'" '.
      ($modSeg[0].'/'.$omfb == $_REQUEST['m'] ? 'style="font-weight:bold;text-decoration:underline;"' : '').'>'.
      htmlspecialchars($omfb).'</a>';
}

?>
<div style="margin-bottom:16px; margin-top:16px; border-bottom: 1px solid gray;">
  <?= implode(' &middot; ', $otherModules) ?>
  <h3>Module: <?= htmlspecialchars($_REQUEST['m']) ?></h3>
</div>
<pre>
<?
  //print_r($module['header']);
?>
</pre>
<div>

  <?= @Michelf\Markdown::defaultTransform(implode(chr(13), $module['text'])) ?>
  
  <?
  if(sizeof($module['text']) == 0)
    print('[ no content available yet for this module ]');
  ?>

</div>
<div style="margin-bottom:16px; margin-top:64px; border-top: 1px solid gray;text-align:center;">
  <?= implode(' &middot; ', $otherModules) ?>
</div>