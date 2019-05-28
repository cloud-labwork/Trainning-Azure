<?php
    $connectionInfo = array("UID" => "aitek230@aitek230", "pwd" => "Programer123##@@l", "Database" => "aitek230", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:aitek230.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if( !$conn ) {
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
   }
?>