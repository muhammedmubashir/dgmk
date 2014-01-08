<?php
class book_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_book_categories()
	{
		$sql = "SELECT
				  c.book_category_id,
				  c.category_name,
				  c.category_detail,
				  c.parent_id,
				  cc.category_name,
				  cc.category_detail
				FROM book_categories c
				  LEFT JOIN book_categories cc
				    ON c.book_category_id = cc.parent_id
				WHERE c.category_status = 1";
	}
}
?>