<?php 

require_once('Utils.class.php');
class UserUpload {
    
   private $db;
   private $options;
    
   public function __construct($params)
   {
      $this->db      = $params['db_link'];
      $this->options = $params['options'];
      
   }
   
   public function processOptions()
   {
       if($this->options['create_table'] ){
           $this->createTable();
       } else {
           $this->readFromFile();
       }
   }
   
   private function createTable(){
        $query = "CREATE TABLE IF NOT EXISTS ".USERS_TBL." (
            `user_id` int(11) unsigned NOT NULL auto_increment,
            `name` varchar(255) NOT NULL ,
            `surname` varchar(255) NOT NULL ,
            `email` varchar(255) NOT NULL,
            PRIMARY KEY  (`user_id`),
            UNIQUE (email)
        )";
        
      try
      {
         $this->db->query($query);
      }
      catch(Exception $Exception){}
   }
   
   public function processData($data){
       $email     = strtolower($data[2]);
       if(Utils::isValidEmail($email)) {
           echo 'Valid Email-> ' . $email. PHP_EOL;
           
           if(!$this->options['dry_run'] ){
               try {
                   //now insert the data
                   $userData = array();
                   $userData['name']  = ucfirst($data[0]);
                   $userData['surname']  = ucfirst($data[1]);
                   $userData['email'] = $email;
                   
                   $params          = array();
                   $params['table'] = USERS_TBL;
                   $params['data']  = $userData;
                   $userId = $this->db->insert($params);
                   
                   if($userId) echo 'New Insert id: '.$userId . PHP_EOL;
               } catch(Exception $e){
                   echo $e->getMessage();
               }
           }
       }
       else {
           echo 'Not Valid' . $email. PHP_EOL;
       }
   }
   
   public function readFromFile(){
      try
      {
          $handle = fopen($this->options['file'], "r");
          if (!$handle) {
             throw new Exception('Failed to open file');
          }
          else {
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $this->processData($data);
             }
             fclose($handle);
          }
      }
      catch(Exception $e) 
      {
         die($e->getMessage());
      }
   }
   
}
?>