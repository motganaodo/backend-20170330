<?php
/**
 * 
 */
class View
{
    protected $message;
    protected $content;
    /**
     * Generate output for client
     * @param  string $dir_file
     * @return
     */
    public function render($dir_file = '')
    {
        $message = $this->message;
        $content = $this->content;
        
        include(DIR_VIEW . '/layer.php');
    }

    /**
     * 
     * @param string $name  variable name
     * @param mixed $value 
     */
    public function set($name, $value)
    {
        $this->$name = $value;
    }

    public function get($name)
    {
        return $this->$name;
    }

}

?>