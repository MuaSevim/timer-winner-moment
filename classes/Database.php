<?php

class Database
{
    /**
     * Hostname
     * @var string
     */
    protected $db_host;

    /**
     * Database Name
     * @var string
     */
    protected $db_name;

    /**
     * DB Username
     * @var string
     */
    protected $db_user;

    /**
     * DB Password
     * @var string
     */
    protected $db_password;


    /**
     * Constructor
     * @param string $host Hostname
     * @param string $name Database name
     * @param string $user Username
     * @param string $pass Password
     */
    public function __construct($host, $name, $user, $password)
    {
        $this->db_host = $host;
        $this->db_name = $name;
        $this->db_user = $user;
        $this->db_password = $password;
    }

    /**
     * Database connection
     * 
     * @return PDO PHP Data Object connection to the database
     */
    public function getConn()
    {
        $dsn = "mysql:host=" . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            return new PDO($dsn, $this->db_user, $this->db_password, $options);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
