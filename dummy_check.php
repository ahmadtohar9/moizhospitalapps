<?php
// Script to insert menu programmatically via CI
define('BASEPATH', 'system/');
define('ENVIRONMENT', 'development');

// Mock CodeIgniter constant
class CI_Controller
{
    public static $instance;
    public function __construct()
    {
        self::$instance =& $this;
    }
}

function &get_instance()
{
    return CI_Controller::$instance;
}

// Load necessary pieces - actually, loading full CI in a standalone script is hard. 
// Easier to create a controller method in a temp controller or existing one, run it via CLI or wget, then remove.
// OR, since I have `run_command`, I can try to find the mysql binary again.

// Let's try to locate mysql binary first.
?>