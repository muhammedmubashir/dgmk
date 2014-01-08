<?php

include('admin_model');
class admin_news extends admin_model
{
	function add_new_news($news)
    {
        $this->db->insert("news", $news);
        $news_id  = $this->db->insert_id();
        return $news_id;
    }    
}

?>