<?php

namespace core;

abstract class Model
{

    private $db;
    protected $table;
    protected $keyField;


    public function __construct(\core\Database $db)
    {
        $this->db = $db;
    }


    public function all()
    {
        return $this->db->query('SELECT * FROM `' . $this->table . '`');
    }


    public function findById($id)
    {
        $rows = $this->db->query(
            'SELECT * FROM `' . $this->table . '` WHERE `' . $this->keyField . '` = ?',
            array('i', $id));

        return $rows[0];
    }


    public function create($values)
    {
        $query = 'INSERT INTO `' . $this->table . '` ';
        $fields = $vars = '';
        $params = array('');

        foreach ($values as $key => $value) {
            $fields .= '`' . $key . '`,';
            $vars .= '?,';
            $params[0] .= 's';
            $params[] = $value;
        }

        $query .= ' (' . rtrim($fields, ',') . ') VALUES (' . rtrim($vars, ',') . ')';
        $this->db->exec($query, $params);
    }


    public function update($id, $values)
    {
        $query = 'UPDATE `' . $this->table . '` SET ';
        $params = array('');

        foreach ($values as $key => $value) {
            if ($key !== $this->keyField) {
                $query .= '`' . $key . '` = ?,';
                $params[0] .= 's';
                $params[] = $value;
            }
        }
        $query = rtrim($query, ',') . ' WHERE `' . $this->keyField . '` = ?';
        $params[0] .= 's';
        $params[] = $id;

        $this->db->exec($query, $params);
    }


    public function delete($id)
    {
        $query = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->keyField . '` = ?';
        $this->db->exec($query, array('i', $id));
    }


    abstract function validate($values, &$validationError);
}