<?

function listDirectory($dir, $level = 0, $label = 'Modules')
{
  $fileEntries = array();
  print('<div style="margin-left: '.($level*16).'px"><h3>'.first($label).'</h3>');
  foreach(file_list('module-data/'.$dir) as $entry)
  {
    $fn = $dir.($dir != '' ? '/' : '').$entry;
    if(is_dir('module-data/'.$fn))
    {
      listDirectory($fn, $level+1, $entry);
    }
    else
    {
      $fileEntries[] = substr($entry, 0, -4);
    }
  }
  if(sizeof($fileEntries) > 0)
  {
    print('<div class="columns" style="width: 500px;">');
    foreach($fileEntries as $moduleEntry)
    {
      print('<div><a href="/module?m='.$dir.'/'.$moduleEntry.'" '.
      (filesize('module-data/'.$dir.'/'.$moduleEntry.'.txt') == 0 ? 'style="color:#aaa"' : '').
      '>'.($moduleEntry).'</a></div>');
    }      
    print('</div>');
  }
  print('</div>');
}

if(isset($_REQUEST['m']))
{
  include('pages/module_view.php');
}
else
{
  listDirectory('');
}

