<?php

class TarTable
{
    
    private $table;
    
    private function security($field)
    {
        return mysql_real_escape_string($field);
    }
    
    private function tableExists($table)
    {
        
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

}

?>