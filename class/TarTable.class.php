<?php

class TarTable
{
    
    private $connection;
    private $hostname, $username, $password, $socket, $database, $table;
    
    private function security($field)
    {
        if (get_magic_quotes_gpc())
        {
            $field = stripslashes(trim($field));
        }
        $field = mysql_real_escape_string($field);
        return $field;
    }
    
    private function tableExists($table)
    {
        
    }
    
    public function query($sql)
    {
        $query = mysql_query($sql) or die(mysql_error());
        return $query;
    }
    
    public function setBase($array)
    {
        $this->hostname = $array["hostname"];
        $this->username = $array["username"];
        $this->password = $array["password"];
        $this->database = $array["database"];
        
        if (isset($array["socket"]))
        {
            $this->socket = $array["socket"];
            $this->hostname .= ":".$this->socket;
        }
        
        $this->connection = mysql_connect($this->hostname, $this->username, $this->password);
        
        if (!$this->connection)
        {
            die(mysql_error());
        }
        else
        {
            $databaseConnection = mysql_select_db($this->database, $this->connection);
            if (!$databaseConnection)
            {
                die(mysql_error());
            }
        }
    }
    
    public function unsetBase()
    {
        if ($this->connection)
        {
            return mysql_close($this->connection);
        }
        else
        {
            return "Please, first open the connection! ";
        }
    }
    
    public function setTable($table)
    {
        $this->table = $table;
    }
    
    public function select($data)
    {
        
    }
    
    public function insert($data)
    {
        $sql = "INSERT INTO ".$this->table." SET ".self::setArray($data);
        return self::query($sql);
    }
    
    public function update($where, $data, $table = null)
    {
        if (empty($table))
        {
            $table = $this->table;
        }
        $sql = "UPDATE ".$table." SET ".self::setArray($data)." WHERE ".self::ifArray($where);
        return self::query($sql);
    }
    
    public function delete($data, $table = null)
    {
        if (empty($table))
        {
            $table = $this->table;
        }
        $sql = "DELETE FROM ".$table." WHERE ".self::ifArray($data);
        return self::query($sql);
    }
    
    private function &setArray($data)
    {
        $return = "";
        if (count($data) > 0)
        {
            foreach ($data as $key => $value)
            {
                $return .= "{$key} = '".self::security($value)."' ";
                $return .= ", ";
            }
        }
        $return = substr(trim($return), 0, -1);
        return $return;        
    }
    
    private function &arrayOrdering($array)
    {
        $return = "";
        if (count($array) == 1)
        {
            foreach($array as $key => $value)
            {
                $return .= " {$key} = '".trim($value)."' ";
            }
        }
        return $return;
    }
    
    private function &ifArray($data)
    {
        $return = "";
        if (is_array($data))
        {
            $return = self::arrayOrdering($data);
        }
        elseif (is_numeric($data) && $data > 0)
        {
            $return = " id = {$data} ";
        }
        elseif (is_string($data))
        {
            $return = " {$data} ";
        }
        return $return;
    }

}

?>