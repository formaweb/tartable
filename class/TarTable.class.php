<?php

class TarTable {
  private $connection;
  private $hostname, $username, $password, $socket, $database, $table;

  private function security($field) {
    if (get_magic_quotes_gpc()) {
      $field = stripslashes(trim($field));
    }
    
    $field = mysql_real_escape_string($field);
    return $field;
  }
  
  public function query($sql) {
    $query = mysql_query($sql) or die(mysql_error());
    return $query;
  }
  
  public function setBase($array) {
    $this->hostname = $array["hostname"];
    $this->username = $array["username"];
    $this->password = $array["password"];
    $this->database = $array["database"];

    if (isset($array["socket"])) {
      $this->socket = $array["socket"];
      $this->hostname .= ":".$this->socket;
    }
    $this->connection = mysql_connect($this->hostname, $this->username, $this->password);

    if (!$this->connection) {
      die(mysql_error());
      return false;
    } else {
      $databaseConnection = mysql_select_db($this->database, $this->connection);
      if (!$databaseConnection) {
        die(mysql_error());
        return false;
      } else {
        return true;
      }
    }
  }
  
  public function unsetBase() {
    if ($this->connection) {
      return mysql_close($this->connection);
    } else {
      return false;
    }
  }
  
  public function setTable($table) {
    $this->table = $table;
  }
  
  public function notSetTable($table) {
    if (is_null($table)) {
      return $this->table;
    } else {
      return $table;
    }
  } 
  
  public function select($options = null) {
    $columns = "*";
    $extend = "";
    $return = "";
    $array = true;

    if ($options != null) {
      foreach ($options as $option => $value) {
        switch ($option) {
          case "table":
          $table = $value;
          break;

          case "columns":
          if ($value != null)
          {
            $columns = self::ifType($value);
          }
          break;

          case "where":
          $extend .= " WHERE ".self::ifType($value);
          break;

          case "order":
          $extend .= " ORDER BY ".self::ifType($value);
          break;

          case "limit":
          $extend .= " LIMIT ".$value;
          break;

          case "array":
          $array = $value;
          break;
        }
      }
    }
    $sql = "SELECT ".$columns." FROM ".self::notSetTable($table).$extend;
    $sql = self::query($sql);

    if ($array) {
      while($row = mysql_fetch_array($sql)) {
        $return[] = $row;
      }
    }
    return $return;
  }

  public function insert($data, $options = null) {
    $table = self::notSetTable($options["table"]);
    $sql = "INSERT INTO ".$this->table." SET ".self::setArray($data);
    return self::query($sql);
  }

  public function update($where, $data, $options = null) {
    $table = self::notSetTable($options["table"]);
    $sql = "UPDATE ".$table." SET ".self::setArray($data)." WHERE ".self::ifType($where);
    return self::query($sql);
  }

  public function delete($data, $options = null) {
    $table = self::notSetTable($options["table"]);
    $sql = "DELETE FROM ".$table." WHERE ".self::ifType($data);
    return self::query($sql);
  }

  public function join($value, $table) {
    $select = self::select(array(
      "table" => $table,
      "where" => $value,
    ));
    return $select[0][1];
  }

  private function &setArray($data) {
    $return = "";
    if (count($data) > 0) {
      foreach ($data as $key => $value) {
        $return .= "{$key} = '".self::security($value)."' ";
        $return .= ", ";
      }
    }
    $return = substr(trim($return), 0, -1);
    return $return;        
  }

  private function &arrayOrdering($array) {
    $return = "";
    if (count($array) == 1) {
      foreach($array as $key => $value) {
        $return .= " {$key} = '".trim($value)."' ";
      }
    }
    return $return;
  }

  private function &ifType($data) {
    $return = "";
    if (is_array($data)) {
      $return = self::arrayOrdering($data);
    } elseif (is_numeric($data) && $data > 0) {
      $return = " id = {$data} ";
    } elseif (is_string($data)) {
      $return = " {$data} ";
    }
    return $return;
  }
}

?>