# stockmgmt
Stock Management System

You need to make following changes

1)  In include/function.class.php file
	protected $db_l_host = "localhost";
	protected $db_l_user = "root";
	protected $db_l_pass = "";
	protected $db_l_name = "test_darshit";

	make your db related changes here.

2)  In include/define.php file
	$SITEURL = $Protocol.$_SERVER['HTTP_HOST']."/test/darshit/";

	make necessary changes to local to your directory where the files resides. Mine were in C:/xampp/htdocs/test/darshit/
	Don't forget to add leading and trailing '/', else it won't work as expected.





