<?
  
  ob_start();
  
  include('pages/index.php');
  
  $lines = array();
  foreach(explode(chr(10), ob_get_clean()) as $line)
    $lines[] = trim($line);
  
  file_put_contents('README.md', implode(' ', $lines));
  
  print('README.md written.');
  