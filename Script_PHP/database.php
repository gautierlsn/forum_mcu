<?php

class Database{
    private static $dbHost = "mysql-gautierluisin.alwaysdata.net";
    private static $dbName = "gautierluisin_forum_mcu";
    private static $dbUsername = "174412";
    private static $dbUserpassword = "forum_mcu_mdp";
    private static $connection = null;
    
    public static function connect(){
        if(self::$connection == null){
            try{
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName , self::$dbUsername, self::$dbUserpassword);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$connection;
    }
    public static function disconnect(){
        self::$connection = null;
    }
}
?>
