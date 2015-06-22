<?php

namespace core;

class Database
{
    private static $instance;
    private $config = array();
    private $connection;

    const ERROR_CONNECT = 'Ошибка подключения к БД';
    const ERROR_QUERY = 'Ошибка получения данных';


    private function __construct($config)
    {
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $config = require CONFIG_DIR . 'database.php';
            self::$instance = new Database($config);
        }
        return self::$instance;
    }


    public function connect()
    {
        if (isset($this->connection)) $this->connection->close();

        $this->connection = new \mysqli(
            $this->config['hostname'],
            $this->config['username'],
            $this->config['password'],
            $this->config['database']);

        if ($this->connection->connect_error) {
            \core\Redirect::error(self::ERROR_CONNECT);
        }

        $this->connection->set_charset("utf8");
    }


    function refValues($arr){
        if (strnatcmp(phpversion(), '5.3') >= 0)
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }


    public function query($query, $params = null)
    {
        if (!isset($this->connetion)) $this->connect();

        $statement = $this->connection->stmt_init();
        if (!$statement->prepare($query)) {
            \core\Redirect::error(self::ERROR_QUERY);
        }

        if (is_array($params)) {
            if (!call_user_func_array(array($statement, 'bind_param'), $this->refValues($params))) {
                \core\Redirect::error(self::ERROR_QUERY);
            }
        }

        if (!$statement->execute() || !($result = $statement->get_result())) {
            \core\Redirect::error(self::ERROR_QUERY);
        }

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $statement->close();

        return $data;
    }


    public function exec($query, $params = null)
    {
        if (!isset($this->connetion)) {
            $this->connect();
        }

        $statement = $this->connection->stmt_init();
        if (!$statement->prepare($query)) {
            \core\Redirect::error(self::ERROR_QUERY);
        }

        if (is_array($params)) {
            if (!call_user_func_array(array($statement, 'bind_param'), $this->refValues($params))) {
                \core\Redirect::error(self::ERROR_QUERY);
            }
        }

        if (!$statement->execute()) {
            \core\Redirect::error(self::ERROR_QUERY);
        }

        return true;
    }
}