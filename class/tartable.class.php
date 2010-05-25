<?php

class TarTable
{
    
    private $table;
    
    private function order($array)
    {
        $i = 0;
        
        foreach($array as $key => $value)
        {
            $i++;
        }
    }
    
    public function select($array)
    {
        
    }
    
    public function setTable($table)
    {
        $this->table = $table;
    }
    
    public function insert($array)
    {
        
    }
    
    public function update($array)
    {
        
    }
    
    public function delete($array)
    {
        
    }

}

?>