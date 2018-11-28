<?php
   // define database related variables
   $database = 'budget_app_test';
   $host = 'mysql.monmouth.edu';
   $user = 'budget_app_test';
   $pass = 'money$422';

   // try to conncet to database
   $dbh = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);

   if(!$dbh){

      echo "unable to connect to database";
   }
   
?>
