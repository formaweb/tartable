<?php

class TarTable
{
    
    private $connection;
    private $hostname, $username, $password, $database, $table;
    
    private function security($field)
    {
        if (get_magic_quotes_gpc())
        {
            $field = stripslashes(trim($field));
        }
        $field = mysql_real_escape_string($field)
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
        
        $this->connection = mysql_connect($this->hostname, $this->username, $this->password);
        
        if (!$this->connection)
        {
            die(mysql_error());
        }
        else
        {
            $databaseConnection = mysql_select_db($this->database, $this->conn);
            if (!$databaseConnection)
            {
                die(mysql_error());
            }
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
        
    }
    
    public function update($data)
    {
        
    }
    
    public function delete($data)
    {
        
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
        elseif (is_string($data))
        {
            $return = " {$data} ";
        }
        return $return;
    }

}

?>