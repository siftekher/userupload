# userupload

sample test:
  php -f user_upload.php create_table=true
  php -f user_upload.php file=users.csv
  php -f user_upload.php file=users.csv dry_run=true
  php -f user_upload.php file=users.csv db=test create_table=true user=root //another db
  php -f user_upload.php file=users.csv db=test 
  
