<?php
/**
 * 
 */
class View
{
    protected $content = array();
    /**
     * Generate output for client
     * @param  string $dir_file
     * @return
     */
    public function render($dir_file = '')
    {
        $content = $this->content;
        
        include(DIR_VIEW . '/layer.php');
    }

    /**
     * 
     * @param string $name  variable name
     * @param mixed $value 
     */
    public function set_content($name, $value)
    {
        $this->content[$name] = $value;
    }

    public function get_content($name)
    {
        return $this->content[$name];
    }

}

?>