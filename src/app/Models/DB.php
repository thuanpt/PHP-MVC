<?php
/**
 * Created by PhpStorm.
 * User: thuanpt
 * Date: 19/07/2017
 * Time: 22:55
 */

namespace App\Models;

use PDO;

class DB extends PDO
{
    const HOST = 'localhost';
    const PORT = '3306';
    const USER = 'root';
    const PASS = 'root';
    const DB_NAME = 'jupiter';

    private static $_db;
    private static $stmt;
    private static $error;

    private static $tableName;
    //private static $sql;

    public static function getDBConnect()
    {
        $dsn = "mysql:host=". self::HOST . ";port=" . self::PORT . ";dbname=" . self::DB_NAME ;
        $option  = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            self::$_db = new PDO($dsn, self::USER, self::PASS, $option);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            self::$error = $e->getMessage();
        }

        return self::$_db;
    }

    public static function getAll($table)
    {
        self::$stmt = self::getDBConnect()->prepare("SELECT * FROM $table");
        self::$stmt->execute();

        $staffsData = array();
        while ($d = self::$stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $staffsData[] = $d;
        }
        return $staffsData;
    }

    public static function getById($table, $id)
    {
        self::$stmt = self::getDBConnect()->prepare("SELECT * FROM $table WHERE id=$id");
        self::$stmt->execute();
        $data = self::$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public static function insertData()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        self::$stmt = self::getDBConnect()->prepare("INSERT INTO staff (name, email, mobile) VALUES ('$name', '$email', '$mobile')");
        self::$stmt->execute();
//
//        $lastID = DB::getDBConnect()->lastInsertId();
//        $data = self::getById($table, $lastID);

        //return $data = self::$stmt;

        return "Them thanh cong";
    }

    public static function updateData($id){
        parse_str(file_get_contents("php://input"),$post);
        $name = $post['name'];
        $email = $post['email'];
        $mobile = $post['mobile'];

        self::$stmt = self::getDBConnect()->prepare("UPDATE staff SET name='$name', email='$email', mobile='$mobile' WHERE id=$id");
        self::$stmt->execute();

        return "Sua thanh cong";
    }

    public static function deleteData($id)
    {
        self::$stmt = self::getDBConnect()->prepare("DELETE FROM staff WHERE id=$id");
        self::$stmt->execute();

        return "Xoa thanh cong!";
    }

}

