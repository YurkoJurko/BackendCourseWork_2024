<?php

namespace core;

class Database
{
    public $pdo;

    public function __construct($login, $password)
    {
        $host = Config::get()->dbHost;
        $name = Config::get()->dbName;
        $this->pdo = new \PDO("mysql:host={$host};dbname={$name}", $login, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function select($table, $fields = "*", $where = null, $limit = null, $offset = null)
    {
        try {
            $fields_string = $this->fieldsImplode($fields);
            $sql = "SELECT {$fields_string} FROM {$table}";
            $params = [];

            if ($where) {
                $where_string = $this->where($where);
                $sql .= " WHERE {$where_string}";
                $params = array_merge($params, $where);
            }

            if ($limit) {
                $sql .= " LIMIT :limit";
                $params['limit'] = (int)$limit;
            }

            if ($offset) {
                $sql .= " OFFSET :offset";
                $params['offset'] = (int)$offset;
            }

            $sth = $this->pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }

            $sth->execute();
            return $sth->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception("Database Query Error: " . $e->getMessage());
        }
    }

    public function insert($table, $data)
    {
        try {
            $fieldsList = implode(", ", array_keys($data));
            $paramsArray = [];
            foreach ($data as $key => $value) {
                $paramsArray[":{$key}"] = $value;
            }
            $paramsList = implode(", ", array_keys($paramsArray));
            $sql = "INSERT INTO {$table} ({$fieldsList}) VALUES ({$paramsList})";
            $sth = $this->pdo->prepare($sql);

            foreach ($paramsArray as $key => $value) {
                $sth->bindValue($key, $value);
            }

            $sth->execute();
            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            throw new \Exception("Database Insert Error: " . $e->getMessage());
        }
    }

    public function update($table, $data, $where)
    {
        try {
            $fieldsList = implode(", ", array_map(function($key) { return "{$key} = :{$key}"; }, array_keys($data)));
            $sql = "UPDATE {$table} SET {$fieldsList}";

            $params = array_merge($data, $where);

            if ($where) {
                $where_string = $this->where($where);
                $sql .= " WHERE {$where_string}";
            }

            $sth = $this->pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }

            $sth->execute();
            return $sth->rowCount();
        } catch (\PDOException $e) {
            throw new \Exception("Database Update Error: " . $e->getMessage());
        }
    }

    public function delete($table, $where)
    {
        try {
            $sql = "DELETE FROM {$table}";
            $params = [];

            if ($where) {
                $where_string = $this->where($where);
                $sql .= " WHERE {$where_string}";
                $params = $where;
            }

            $sth = $this->pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }

            $sth->execute();
            return $sth->rowCount();
        } catch (\PDOException $e) {
            throw new \Exception("Database Delete Error: " . $e->getMessage());
        }
    }

    public function count($table, $where = null)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM {$table}";
            $params = [];

            if ($where) {
                $where_string = $this->where($where);
                $sql .= " WHERE {$where_string}";
                $params = $where;
            }

            $sth = $this->pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }

            $sth->execute();
            return (int) $sth->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception("Database Query Error: " . $e->getMessage());
        }
    }


    protected function where($where)
    {
        if (is_array($where)) {
            $parts = [];
            foreach ($where as $field => $value) {
                $parts[] = "{$field} = :{$field}";
            }
            return implode(' AND ', $parts);
        } elseif (is_string($where)) {
            return $where;
        } else {
            return '1';
        }
    }

    protected function fieldsImplode($fields)
    {
        if (is_array($fields)) {
            return implode(',', $fields);
        } elseif (is_string($fields)) {
            return $fields;
        } else {
            return "*";
        }
    }

}
