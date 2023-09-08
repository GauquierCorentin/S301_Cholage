<?php

/**
 *
 */
class ConnectionBDD {
    private static $instance;
    private static $pdo;


    private function __construct() {
        $config = parse_ini_file('config.ini', true)['database'];
        $host = $config['host'];
        $name = $config['name'];
        $username = $config['username'];
        $password = $this->getPassword();
        try {
            self::$pdo = new PDO("pgsql:host=$host;dbname=$name", $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    private function getPassword() {
        $password_file = __DIR__.'/password.txt';
        if (!file_exists($password_file)) {
            die("Password file not found");
        }
        $password = file_get_contents($password_file);
        if (!$password) {
            die("Could not read password file");
        }
        return $password;
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getpdo(){
        return self::$pdo;
    }
}
?>