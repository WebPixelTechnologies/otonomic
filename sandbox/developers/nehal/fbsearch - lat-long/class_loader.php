<?php
function __autoload($class_name)
{
    //class directories
    $directories = array(
        'classes/',
    );

    //for each directory
    foreach($directories as $directory)
    {
        //see if the file exsists
        if(file_exists($directory.$class_name . '_class.php'))
        {
            require_once($directory.$class_name . '_class.php');
            //only require the class once, so quit after to save effort (if you got more, then name them something else
            return;
        }
    }
}

?>