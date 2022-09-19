<?php
class DB {
    protected static $con;

    private function __construct() {

        try {
            $dns = 'mysql:host=localhost;dbname=g1c1_blog;charset=utf8';
            self::$con = new PDO($dns, 'root', '');
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo "Could not connected to database";
            exit;
        }

    }

    public static function getConnection()
    {
        if( !self::$con ){
            new DB();
        }

        return self::$con;
    }
}