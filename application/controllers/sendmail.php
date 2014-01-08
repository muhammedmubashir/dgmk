<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sendmail extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
    }
    
    function contact()
    {
    	echo "<pre>";
    	print_r($_POST);
    	echo "</pre>";
    }

    function order()
    {

    }

    function visa()
    {

    }
}

?>