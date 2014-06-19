<?php

class Filestore 
{
    public $filename = '';
    public $is_csv = false;

    public function __construct($filename = '') 
    {
        $this->filename = strtolower($filename);

        if(substr($this->filename, -3) == 'csv')
        {
            $this->is_csv = true;
        }
    }

    public function read()
    {
        if($this->is_csv)
        {
            return $this->read_csv();
        }
        else
        {
            return $this->read_lines();    
        }    
    }

    public function write($array)
    {
        if($this->is_csv)
        {
            $this->write_csv($array);
        } 
        else
        {
            $this->write_lines($array);    
        }   
    }

  
    private function read_lines()
    {
        $array = [];
        if (empty($filename)) 
        {
            $filename = '';

        }
    
            $contents = ''; 

        if (is_readable($filename))    
        {
            $handle = fopen($filename, 'r');
            $contents = trim(fread($handle, $bytes));
            $array = explode(PHP_EOL, $contents);
            fclose($handle);
            return $array;
        }
    }

    private function write_lines($array)
    {
        $handle = fopen($this->filename, 'w');
        foreach ($array as $item) {
        fwrite($handle, $item . PHP_EOL);       
    }
    fclose($handle);
}
    
    private function read_csv()
    {
        $addresses = [];
        $handle = fopen($this->filename, 'r');
        while(!feof($handle)) 
        {
            $row = fgetcsv($handle);
            if(!empty($row))
            {       
                $addresses[] = $row;
            }
        }
        fclose($handle); 
        return $addresses;
    }
    
    private function write_csv($array)
    {
        $handle = fopen($this->filename, 'w');
        foreach ($array as $fields) 
        {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }          
}

?>