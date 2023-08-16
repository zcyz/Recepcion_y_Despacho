<?php
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "prueba_usuarios",
    "UID" => "sa",
    "PWD" => "zsoftpanama",
    "CharacterSet" => "UTF-8",
    "Encrypt" => 1,
    "TrustServerCertificate" => 1
);
$con = sqlsrv_connect($serverName, $connectionOptions);

if ($con) {
    echo "Conexion Exitosa";
} else {
    echo "Fallo en la conexion";
    die(print_r(sqlsrv_errors(), true));
}




?>