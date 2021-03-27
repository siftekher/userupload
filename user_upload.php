<?php 

  $dbInfo = array();

  $dbInfo['db']   = 'catalyst';
  $dbInfo['user'] = 'root';
  $dbInfo['pass'] = '';
  $dbInfo['host'] = 'localhost';
  
  require_once('config.php');
  require_once('DB.class.php');
  require_once('UserUpload.class.php');
    
  $allowedOptions = array(
     'file' => 'users.csv',
     'create_table' => false,
     'dry_run' => false
  );
  
  //read the arguments
  foreach ($argv as $arg){
     $arg_list = explode("=", $arg);
     
     if(count($arg_list) > 1) {
         if(isset($dbInfo[$arg_list[0]]))  $dbInfo[$arg_list[0]] = $arg_list[1];
         
         if(isset($allowedOptions[$arg_list[0]]))  $allowedOptions[$arg_list[0]] = $arg_list[1];
     }
  }
  
  try
  {
     $dbObj = new DB($dbInfo);
  }
  catch(Exception $e)
  {
     die($e->getMessage());
  }
  
  $params   =  array();
  $params['db_link'] = $dbObj;
  $params['options'] = $allowedOptions;
  
  $UserUploadObj = new UserUpload($params);
  $UserUploadObj->processOptions();
?>