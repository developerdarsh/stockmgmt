<?php
	$dashboard_main_array = array(
		0 => array("danger", $db->rpgetTotalRecord("user", "isActive=1 AND isDelete=0"), "User(s)", "manage-user", "mdi mdi-account"),		
		1 => array("info", $db->rpgetTotalRecord("faq", "isDelete=0"), "FAQ(s)", "manage-package", "mdi-comment-question"),		
		2 => array("warning", $db->rpgetTotalRecord("static_page", "isDelete=0"), "Static Page(s)", "manage-static-page", "mdi-format-line-weight"),
		3 => array("success", $db->rpgetTotalRecord("testimonial", "isDelete=0"), "Testimonial(s)", "manage-testimonial", "mdi-account-star"),
		//4 => array("dark", $db->rpgetTotalRecord("service", "isDelete=0"), "Service(s)", "manage-service", "mdi-camera-iris"),		
	);
?>	