<?php
    include('../config/PDO_config.php');

    function connect() {
        $dsn = sprintf('mysql:dbname=%s;host=%s'
            ,constant('MYSQL_DBNAME')
            ,constant('MYSQL_HOST')
        );
        
        $dbh = new PDO($dsn, constant('MYSQL_USER'), constant('MYSQL_PASSWORD'));
    
        return $dbh;
    }
?>