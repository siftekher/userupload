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
   
   private function createTable(){
        $query = "CREATE TABLE IF NOT EXISTS ".USERS_TBL." (
            `user_id` int(11) unsigned NOT NULL auto_increment,
            `first_name` varchar(255) NOT NULL ,
            `last_name` varchar(255) NOT NULL ,
            `user_email` varchar(255) NOT NULL,
            PRIMARY KEY  (`user_id`),
            UNIQUE (user_email)
        )";
        
      try
      {
         $this->db->query($query, '');
      }
      catch(Exception $Exception){}
   }
   
   public function processData($data){
       $email     = strtolower($data[2]);
       if(Utils::isValidEmail($email)) {
           echo 'Valid Email-> ' . $email. PHP_EOL;
           
               //now insert the data
               $userData = array();
               $userData['first_name'] = ucfirst($data[0]);
               $userData['last_name']  = ucfirst($data[1]);
               $userData['user_email'] = $email;
               
               $params          = array();
               $params['table'] = USERS_TBL;
               $params['data'] = $userData;
               $this->db->insert($params);
 
       }
       else {
           echo 'Not Valid' . $email. PHP_EOL;
       }
   }
   
   
   
}
?>