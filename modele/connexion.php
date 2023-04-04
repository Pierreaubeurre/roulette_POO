<?php
class connection extends mysqli {//classe permettant la connexion à la base sql

    static string $host = "localhost";
    static string $user = "Roulette";
    static string $passwd = "roulette";
    static string $base = "BD_ROULETTE";
    static int $port = 3306;
    static $socket = null;
    static string $charset = 'utf8mb4';


    public function __construct() {

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        parent::__construct($this::$host, $this::$user, $this::$passwd, $this::$base, $this::$port, $this::$socket);
        $this->set_charset($this::$charset);

    }
}

?>

