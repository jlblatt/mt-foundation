<?php

$_mt = array('msgs' => array());

error_reporting(E_ALL); 
//error_reporting(0);

ob_start();

$_mt['args'] = preg_split("/\//", $_SERVER['REQUEST_URI'], -1, PREG_SPLIT_NO_EMPTY);

if(!$_mt['args'])
{
  _mt_500('mt: no args'); 
  return;
}

$_mt['server_path'] = $_mt['args'][0];

if(file_exists('conf/conf.php'))
{
  try
  {
    require_once('conf/conf.php');
    $_mt['init'] = true;
  }

  catch(Exception $e)
  {
    _mt_500("mt: conf.php error");
    return;
  }
}

else
{
  $_mt['page_title'] = 'Install';
  $_mt['page'] = 'install';
  $_mt['init'] = false;
  return;
}

if(count($_mt['args']) > 1)
{
  $_mt['page'] = preg_replace("/[^\w\-\/]/", "", implode('/', array_slice($_mt['args'], 1)));

  if(!file_exists("templates/" . $_mt['page'] . ".php") && !file_exists("templates/". $_mt['page'] . "/index.php"))
  {
    _mt_404();
    return;
  }
}

else
{
  $_mt['page_title'] = 'Dashboard';
  $_mt['page'] = 'dashboard';
}





function _mt_404()
{
  global $_mt;
  $_mt['page_title'] = '404 - Not Found :(';
  $_mt['page'] = '404';
  header($_SERVER['SERVER_PROTOCOL'] . '404 Not Found');
}

function _mt_500($msg)
{
  global $_mt;
  $_mt['page_title'] = '500 - Internal Server Error :(';
  $_mt['page'] = '500';
  $_mt['msg'] = $msg;
  header($_SERVER['SERVER_PROTOCOL'] . '500 Internal Server Error');
}


