<?php
class Database {
    private $host = Config::DB_HOST; 
    private $username = Config::DB_USER; 
    private $password = Config::DB_PASS; 
    private $database = 'kid4414'; 
    private $port = Config::DB_PORT;
    private $conn;


    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);

        if ($this->conn->error) {
            die('Query Error: ' . $this->conn->error);
        }

        return $result;
    }

    public function select($table, $conditions = []) {
        $sql = "SELECT * FROM `$table`";
        if (!empty($conditions)) {
            $sql .= " WHERE " . $this->buildConditions($conditions);
        }

        $result = $this->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_map([$this, 'escapeString'], array_values($data)));

        $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";
        $this->query($sql);

        return $this->conn->insert_id;
    }

    public function update($table, $data, $conditions) {
        $set = $this->buildSet($data);
        $where = $this->buildConditions($conditions);

        $sql = "UPDATE `$table` SET $set WHERE $where";
        $this->query($sql);

        return $this->conn->affected_rows;
    }

    public function delete($table, $conditions) {
        $where = $this->buildConditions($conditions);

        $sql = "DELETE FROM `$table` WHERE $where";
        $this->query($sql);

        return $this->conn->affected_rows;
    }

    private function buildConditions($conditions) {
        $where = [];
        foreach ($conditions as $column => $value) {
            $where[] = "`$column` = " . $this->escapeString($value);
        }
        return implode(" AND ", $where);
    }

    private function buildSet($data) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "`$column` = " . $this->escapeString($value);
        }
        return implode(", ", $set);
    }

    private function escapeString($value) {
        return "'" . $this->conn->real_escape_string($value) . "'";
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>
