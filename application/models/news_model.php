<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class news_model extends CI_Model
{
    function __construct()
    {
        parent:: __construct(); 
        $this->load->library('email');   
    }
    function get_all_news()
    {
    	$sql = "select * from news where news_status = 1 and is_delete = 1";
    	$queryResult = $this->db->query($sql);
    	$news_data = array();
    	if($queryResult->num_rows() > 0)
    	{
    		$news_data = $queryResult->result_array();
    	}
        return $news_data;
    }

    function naat_model()
    {
        $sql = "select * from naat";
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    function naat_cat($q)

    {
        $sql="SELECT * FROM naat WHERE category = '".$q."'";
        $result = $this->db->query($sql);
        return $result->result_array();
    }


    function up_coming()

    {
        $sql = "select * from up_coming_event where ev_status = '1'";
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    function artical()
    {
        $sql = "SELECT *, SUBSTR(article_title,1,500) as short_desc from articles";
        //$sql = "select * from articles";
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    function detail_artical($id)
    {
        $sql = "select * from articles where article_id = '$id'";
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    function books($bid)
    {
        $sql = "SELECT c.*,b.* from categories c INNER JOIN books b on c.category_id = b.category_id where c.category_id = '$bid'";
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    function categories()
    {
        $sql = "SELECT * from categories";
        $result = $this->db->query($sql);
        return $result->result_array();
    }
}