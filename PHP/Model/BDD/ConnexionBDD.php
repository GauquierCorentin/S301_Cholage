<?php

/**
Singleton
 * @package ConnexionBDD
 * @author Corentin Gauquier
 */
class ConnexionBDD {
    private static $instance;
    private static $pdo;

    // Le constructeur de la classe
    /**
     * @author Corentin Gauquier
     */
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

    // Simple fonction permettant de recupérer le mot de passe dans un fichier extérieur
    /**
     * @author Corentin Gauquier
     */
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

    // Fonction permettant de récupérer l'instance dans une autre page (Singleton)
    /**
     * @author Corentin Gauquier
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Fonction pour récupérer l'objet pdo dans le but de faire des requêtes
    /**
     * @author Corentin Gauquier
     */
    public static function getpdo(){
        return self::$pdo;
    }
}
?>
