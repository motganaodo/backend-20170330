<?php
/**
 * 
 */
class View
{
    /**
     * Generate output for client
     * @param  string $dir_file
     * @return
     */
    public function render($dir_file = '')
    {
        include(DIR_VIEW . '/layer.php');
    }

}

?>