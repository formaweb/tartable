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
    
    
    private function &arraySplit($array)
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
            $return = self::arraySplit($data);
        }
        elseif (is_string($data))
        {
            $return = " {$data} ";
        }
        
        return $return;
    }

}

?>