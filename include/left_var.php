<?php
	// "$page" variable in the page should match with second element of the array		
	$left_pages_array0 = array(
		"0"=>array("Products", "product", "manage-product/"),
	);
	$left_pages_array1 = array(
		"0"=>array("Sales", "sales", "manage-sales/"),
	);
	
	// "$main_page" variable in the page should match with second element of the array
	$left_head_array = array(
		0	=>array("Products", "product", $left_pages_array0, "mdi-format-list-bulleted"),
		1	=>array("Sales", "sales", $left_pages_array1, "mdi-format-list-bulleted"),
	);

	$left_main_array = array(
		0	=> 	$left_head_array[0],
		1	=> 	$left_head_array[1],
	);
?>