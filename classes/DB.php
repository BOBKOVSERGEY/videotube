<?php

class DB {

    private static function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=videotube;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = [])
    {
        $statement = self::connect()->prepare($query);
        return $statement->execute($params);

    }

    public static function fetchAll($query, $params = [])
    {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public static function fetchOne($query, $params = [])
    {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}