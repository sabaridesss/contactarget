<?
/*****************************************************************************
 *                                                                           *
 * Desss Inc                                                         *
 * Copyright (c) 2004 Desss Inc. All rights reserved.         *
 *                                                                           *
 ****************************************************************************/
//	database functions :: MySQL
class mysql_class 
{
function db_connect($host,$user,$pass) //create connection
{
	return mysql_connect($host,$user,$pass);
}

function db_select_db($name) //select database
{
	return mysql_select_db($name);
}

function db_query($s) //database query
{
	return mysql_query($s);
}

function db_fetch_row($q) //row fetching
{
	return mysql_fetch_row($q);
}

function db_fetch_array($q) //row fetching
{
	return mysql_fetch_assoc($q);
}

function db_bof($q,$numrow) //row fetching
{
  $bof=mysql_data_seek($q, $numrow);
	return $bof;

}

function db_set_identity($table) //actual for MSSQL only
{
	return 1;
}

function db_insert_id($gen_name = "") //id of last inserted record
				//$gen_name is used for InterBase
{
	return mysql_insert_id();
}

function db_error() //database error message
{
	return mysql_error();
	//echo "couldn't connect to database";
}

// Function to Execute the query

function get_query_result($query)
	{
	
		$query_result = mysql_query($query);
		
		 
		return $query_result;
	}
//***********************************************************************************************************
// Function to Fetch records in array
function get_fetch_record($result)
	{	

		$data = 0 ;
		while ($row = mysql_fetch_assoc($result)) 
		{
			$result_set[$data] = $row;
			$data++ ;
		}
		
		mysql_free_result($result);	
	 return $result_set;
	}
	
//************************************************************************************************************

	// FUNCTION TO FIND THE NUMBER OF RECORDS
	
	function get_num_record($result)
	{
	
		$num_result = mysql_num_rows($result);
		
		return $num_result;
	}	

	function get_topmenus_query(){

		$cat_query = "select * from menu_page_tbl where is_menu=1 ORDER BY order_id ASC";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}
	
	function get_topmenus(){

		$cat_query = "select * from menu_page_tbl where is_menu=1 ORDER BY order_id ASC";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}
	
	function get_products_query(){

		$products = "select * from products ORDER BY prod_id ASC LIMIT 0, 5";
		$products = mysql_query($products);
		return $products;
	}
	
	function get_products_query_for_admin(){

		$products = "select * from products ORDER BY prod_id ASC";
		$products = mysql_query($products);
		return $products;
	}
	
	function get_products_pagination_query($record_no){

		$products = "select * from products ORDER BY prod_id ASC LIMIT ".$record_no.", 5";
		$products = mysql_query($products);
		return $products;
	}
	
	function get_products_count_query(){

		$products = "select * from products ORDER BY prod_id  ASC";
		$products = mysql_query($products);
		$products_count = mysql_num_rows($products);
		return $products_count;
	}
	
	function get_products_selected_category_count_query($cat_id){

		$products = "select * from products where prod_category='".$cat_id."' ORDER BY prod_id  ASC";
		$products = mysql_query($products);
		$products_count = mysql_num_rows($products);
		return $products_count;
	}
	
	function get_products_for_edit($prod_id){

		$cat_query = "select * from products where prod_id='".$prod_id."'";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}


	function get_title_query($cat_id){

		$cat_query = "select * from main_category_list  where  Main_category_ID = '$cat_id' ";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}
	
	function get_submenus_query($category_id){

		$subat_query = "select * from page_contents where cat_id = '$category_id' ";
		$subcat_result = mysql_query($subat_query);
		return $subcat_result;

	}


	function get_childsubmenus_query($sub_id){

		$subat_query = "select * from sub_subpagecontents where subcat_id = '$sub_id' ";
		$subcat_result = mysql_query($subat_query);
		return $subcat_result;

	}

  function get_tab_menus_query($subcat_id){

	  $tabs_query  = "select * from taps_tpl where sub_id = '$subcat_id' ";
	  $tabs_result = mysql_query($tabs_query);
	  return $tabs_result;

  }

 function overview_for_sub_category($sub_cat){
 
	$query  = "select * from `page_contents` where `id` = '$sub_cat'";
											 
	$result = get_query_result($query);
    return  $result;
 }


  function overview_for_child_category($child_id){
 
	$query  = "select * from `sub_subpagecontents` where `sub_id` = '$child_id'";
											 
	$result = get_query_result($query);
    return  $result;
 }

function insert_email_subscriber($email_subscriber){

	$query = "insert into email_subscriber(email,created_date) values('$email_subscriber',now())";

	$result = mysql_query($query);

	return $result;
}

//********************************************************************************************************************************
// Function to get search result

		function get_search_result_query_page_contents($search_data="",$limit=""){
		
		/*	echo $query = "select * from `page_contents`,`sub_subpagecontents` where `page_contents`.`content` LIKE '%".addslashes($search_data)."%' OR
					    
					  `page_contents`.`meta_keyword` LIKE '%".addslashes($search_data)."%' OR
					  
					  `sub_subpagecontents`.`content` LIKE '%".addslashes($search_data)."%' OR
					  
					  `sub_subpagecontents`.`meta_keyword` LIKE '%".addslashes($search_data)."%'  $limit";    */
		 
                $query = "select * from `menu_page_tbl` where `real_description` LIKE '%".addslashes($search_data)."%' OR `meta_keyword` LIKE '%".addslashes($search_data)."%' OR `h1_title` LIKE '%".addslashes($search_data)."%' LIMIT 0,15";
			 	  
			$result = $this->get_query_result($query);
	
		   return  $result;
		}	
 //*******************************************************************************************************************************
		function get_search_result_query_subpagecontents($search_data="",$limit=""){
		
		/*	echo $query = "select * from `page_contents`,`sub_subpagecontents` where `page_contents`.`content` LIKE '%".addslashes($search_data)."%' OR
					    
					  `page_contents`.`meta_keyword` LIKE '%".addslashes($search_data)."%' OR
					  
					  `sub_subpagecontents`.`content` LIKE '%".addslashes($search_data)."%' OR
					  
					  `sub_subpagecontents`.`meta_keyword` LIKE '%".addslashes($search_data)."%'  $limit";    */
		 
                $query = "select * from `menu_page_tbl` where `real_description` LIKE '%".addslashes($search_data)."%' OR `meta_keyword` LIKE '%".addslashes($search_data)."%' OR `h1_title` LIKE '%".addslashes($search_data)."%' LIMIT 0,15";
			 	  
			$result = $this->get_query_result($query);
	
		   return  $result;
		}	

//*******************************************************************************************************************************
		function get_search_result_query_tabcontents($search_data="",$limit=""){
		
		/*	echo $query = "select * from `page_contents`,`sub_subpagecontents` where `page_contents`.`content` LIKE '%".addslashes($search_data)."%' OR
					    
					  `page_contents`.`meta_keyword` LIKE '%".addslashes($search_data)."%' OR
					  
					  `sub_subpagecontents`.`content` LIKE '%".addslashes($search_data)."%' OR
					  
					  `sub_subpagecontents`.`meta_keyword` LIKE '%".addslashes($search_data)."%'  $limit";    */
		 
                $query = "select * from `tabs_tbl` where `Tab_Description` LIKE '%".addslashes($search_data)."%' LIMIT 0,15";
			 	  
			$result = $this->get_query_result($query);
	
		   return  $result;
		}	


//********************************************************************************************************************************
// Function to get main menu contents

		function get_page_contents_for_main_menu($main_cat_id){
		
                $query = "select * from `page_contents` where `cat_id` = '$main_cat_id'";
			 	  
			$result = get_query_result($query);
	
		   return  $result;
		}	


//********************************************************************************************************************************
// Function to get search result

		function get_sub_page_contents_for_main_menu($sub_cat_id){
		
                $query = "select * from `sub_subpagecontents` where `subcat_id` = '$sub_cat_id'";
			 	  
			$result = get_query_result($query);
	
		   return  $result;
		}
		
		function get_prod_category_query(){

		$cat_query = "select * from prod_category ORDER BY id  ASC";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}
	
	function get_prod_category_for_edit($cat_id){

		$cat_query = "select * from prod_category where id='".$cat_id."'";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}	
	
	function get_products_selected_category($cat_id){

		$cat_query = "select * from products where prod_category='".$cat_id."' ORDER BY prod_id  ASC LIMIT 0, 5";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}
	
	function get_products_pagination_selected_category($record_no,$cat_id){

		$cat_query = "select * from products where prod_category='".$cat_id."' ORDER BY prod_id  ASC LIMIT ".$record_no.", 5";
		$cat_result = mysql_query($cat_query);

		return $cat_result;
	}
	
	function get_max_prod_id() {

		$prod_query = "SELECT max(prod_id) as max_id FROM products";
		$prod_result = mysql_query($prod_query);
		return $prod_result;
	}
}




?>
