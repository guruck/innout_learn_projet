<?php

class Database{

  public static function getConnection(){
    $envPath = realpath(dirname(__FILE__) . '/../.env');
    $env = parse_ini_file($envPath);
    $conn = new \mysqli("{$env['hostname']}:{$env['dtbsport']}", $env['username'], $env['password'], $env['database']);
    if(isset($conn->conect_error)){
      die('Erro: ' . $conn->conect_error);
    }
    mysqli_set_charset($conn,"utf8");
    return $conn;
  }

  public static function getResultFromQuery($sql){
    $conn = self::getConnection();
    $result = $conn->query($sql);
    $conn->close();
    return $result;
  }

  public static function executeFromQuery($sql){
    $conn = self::getConnection();
    if(!mysqli_query($conn, $sql)){
      throw new Exception(mysqli_error($conn));
    }
    $id = $conn->insert_id;
    $conn->close();
    return $id;
  }

}