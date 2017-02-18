<?
  
  ob_start();
  
  include('pages/index.php');
  
  file_put_contents('README.md', ob_get_clean());
  
  print('README.md written.');
  