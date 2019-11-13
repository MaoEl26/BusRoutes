<?php
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'remotemysql.com');
    define('DB_USERNAME', 'RXWuaQvtL6');
    define('DB_PASSWORD', 'w3tA3C2xKM');
    define('DB_NAME', 'RXWuaQvtL6');
     
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
     
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>

<!-- var pool = mysql.createPool( {
  		adapter: 'msql',
        connectionLimit: 10,
        host: 'remotemysql.com',
		user: 'RXWuaQvtL6',
		password: 'w3tA3C2xKM',
		datablase: 'RXWuaQvtL6',
		port: '3306'
    
}) -->