
<?php

function getDatabase() {

   $config = parse_ini_file('config.ini', true);

   $dbHost = $config['database']['host'];
   $dbUsername = $config['database']['username'];
   $dbPassword = $config['database']['password'];
   $dbName = $config['database']['dbname'];

   return new PDO("mysql:host=".$dbHost.":3306;dbname=".$dbName.";charset=utf8", $dbUsername, $dbPassword);
}

?>