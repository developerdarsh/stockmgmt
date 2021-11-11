<?php
class Functions 
{
	/** Database Detail **/
  
	protected $db_l_host = "localhost";
	protected $db_l_user = "root";
	protected $db_l_pass = "";
	protected $db_l_name = "test_darshit";
		
	protected $con = false; 
	public $myconn; 
	
	function __construct() {
		global $myconn;
		$myconn = @mysqli_connect($this->db_l_host,$this->db_l_user,$this->db_l_pass,$this->db_l_name);
		
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();die;
		}
	}
	
	public function rpgetData($table, $rows = '*', $where = null, $order = null,$die=0) // Select Query, $die==1 will print query
	{		
		$results = array();
		$q = 'SELECT '.$rows.' FROM '.$table;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($order != null)
			$q .= ' ORDER BY '.$order;
		if($die==1){ echo $q;die; }
		if($this->tableExists($table))
		{
			if(@mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q))>0){
				$results = @mysqli_query($GLOBALS['myconn'],$q);
				return $results;
			}else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	public function rpgetValue($table, $row=null, $where=null,$die=0) // single records ref HB function
	{
		if($this->tableExists($table) && $row!=null && $where!=null)
		{
			$q = 'SELECT '.$row.' FROM '.$table.' WHERE '.$where;
			//echo $q . '<br /><br />';
			if($die==1){ echo $q;die; }
			if(@mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q))>0){
				$results = @mysqli_fetch_assoc(mysqli_query($GLOBALS['myconn'],$q));
				return $results[$row];
			}else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	
	public function rpgetTotalRecord($table, $where = null,$die=0) // return number of records
	{
		$q = 'SELECT * FROM '.$table;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($die==1){
			echo $q;die;
		}
		if($this->tableExists($table))
			return @mysqli_num_rows(@mysqli_query($GLOBALS['myconn'],$q))+0;
		else
			return 0;
	}
	
	public function rpgetTotalRecord_JoinData2($table, $join, $where = null, $die=0) // return number of records
	{
		$results = array();
		$q = 'SELECT * FROM '.$table. $join;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($die==1){ echo $q;die; }
		return mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q))+0;
	}
	
	public function minsert($table,$rows,$die=0) // MMinsert - Insert and Die Values 
    {	
		if($this->tableExists($table))
        {		
            $insert = 'INSERT INTO '.$table.' SET ';
            $keys = array_keys($rows);

            for($i = 0; $i < count($rows); $i++)
           	{
                if(is_string($rows[$keys[$i]]))
                {
                    $insert .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $insert .= $keys[$i].'='.$rows[$keys[$i]];
                }
                if($i != count($rows)-1)
                {
                    $insert .= ',';
                }
            }
            //echo $insert . '<br /><br />';

			if($die==1){
				echo $insert;die;
			}
            $ins = @mysqli_query($GLOBALS['myconn'],$insert);           
            if($ins)
            {
				$last_id = mysqli_insert_id($GLOBALS['myconn']);
                return $last_id;
            }
            else
            {
               return false;
			}
        }
    }
	
	public function rpdelete($table,$where = null,$die=0)
	{
		if($this->tableExists($table))
		{
			if($where != null)
			{
				$delete = 'DELETE FROM '.$table.' WHERE '.$where;
				if($die==1){
					echo $delete;die;
				}
				$del = @mysqli_query($GLOBALS['myconn'],$delete);
			}
			if($del)
			{
				return true;
			}
			else
			{
			   return false;
			}
		}
		else
		{
			return false;
		}
	}
    public function rpupdate($table,$rows,$where,$die=0) //update query
	{
		if($this->tableExists($table))
		{
			// Parse the where values
			// even values (including 0) contain the where rows
			// odd values contain the clauses for the row
			//print_r($where);die;
			
			$update = 'UPDATE '.$table.' SET ';
			$keys = array_keys($rows);
			for($i = 0; $i < count($rows); $i++)
			{
				if(is_string($rows[$keys[$i]]))
				{
					$update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
				}
				else
				{
					$update .= $keys[$i].'='.$rows[$keys[$i]];
				}
				 
				// Parse to add commas
				if($i != count($rows)-1)
				{
					$update .= ',';
				}
			}
			$update .= ' WHERE '.$where;

			//echo $update . '<br /><br />';
			if($die==1){
				echo $update;die;
			}
			//$update = trim($update," AND");
			$query = @mysqli_query($GLOBALS['myconn'],$update);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function tableExists($table)
	{
		return true;
	}
	
	public function rpdupCheck($table, $where = null,$die=0) // Duplication Check
	{
		$q = 'SELECT id FROM '.$table;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($die==1){ echo $q;die; }
		if($this->tableExists($table))
		{
			$results = @mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q));
			if($results>0){
				return true;
			}else{
				return false;
			}
		}
		else
			return false;
	}
	
	public function rplocation($redirectPageName=null) // Location
	{
		if($redirectPageName==null){
			header("Location:".$this->SITEURL);
			exit;
		}else{
			header("Location:".$redirectPageName);
			exit;
		}
	}
	
	public function rpnum($val,$deci="0",$sep=".",$thousand_sep=","){
		return number_format($val,$deci,$sep,$thousand_sep);
	}
	
	public function clean($string)
	{
		$string = trim($string);			// Trim empty space before and after
		if(get_magic_quotes_gpc()) {
			$string = stripslashes($string);	// Stripslashes
		}
		$string = mysqli_real_escape_string($GLOBALS['myconn'],$string);	// mysql_real_escape_string
		return $string;
	}

	public function rpDate($date, $format="m/d/Y H:i A"){
		return date_format(date_create($date),$format);
	}

	public function rpgetJoinData($table1,$table2,$join_on,$rows = '*',$where = null, $order = null,$die=0) // Select Query, $die==1 will print query
	{
		$results = array();
		$q = 'SELECT '.$rows.' FROM '.$table1." JOIN ".$table2." ON ".$join_on;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($order != null)
			$q .= ' ORDER BY '.$order;
		if($die==1){ echo $q;die; }

		if(@mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q))>0){
			$results = @mysqli_query($GLOBALS['myconn'],$q);
			return $results;
		}else{
			return false;
		}
	}
	
	public function rpgetJoinData2($table, $join, $rows = '*', $where = null, $order = null,$die=0) // Select Query, $die==1 will print query
	{
		$results = array();
		$q = 'SELECT '.$rows.' FROM '.$table. $join;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($order != null)
			$q .= ' ORDER BY '.$order;
		if($die==1){ echo $q;die; }

		//echo $q . '<br /><br>';
		if(mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q))>0){
			$results = @mysqli_query($GLOBALS['myconn'],$q);
			return $results;
		}else{
			return false;
		}
	}
    public function getAddButton($ctable,$ctable1,$url=null)
    {
		if($ctable!="" && $ctable1!=""){
			if($url!=null){
				?>
				<a class="btn btn-gradient-primary mb-3" href="<?php echo $url; ?>" title="Add <?php echo $ctable1; ?>"><i class="mdi mdi-database-plus"></i></a>
				<?php
			}else{
				?>
				<a class="btn btn-gradient-primary mb-3" href="<?php echo SITEURL; ?>add-<?php echo $ctable; ?>/add/" title="Add <?php echo $ctable1; ?>"><i class="mdi mdi-database-plus"></i></a>
				<?php
			}
		}	
    }

	public function getDeleteButton()
    {
		?>
		<button type="button" class="btn btn-gradient-danger mb-3" onClick="return bulk_delete();" title="Delete"><i class="mdi mdi-delete-sweep"></i></button>
		<?php
    }

	public function rpgetTablePaginationBlock($pagiArr){
		?>
		<div class="tablePagination" style="margin-bottom: 5px;">
			<div class="row">
				<div class="col-md-2">
					<div class="dataTables_info dataTables_length"> Rows Limit:
						<select id="numRecords" class="form-control input-sm" onChange="changeDisplayRowCount(this.value);">
							<option value="10" <?php if ($_REQUEST["show"] == 10 || $_REQUEST["show"] == "" ) { echo ' selected="selected"'; }  ?> >10</option>
							<option value="25" <?php if ($_REQUEST["show"] == 25) { echo ' selected="selected"'; }  ?> >25</option>
							<option value="50" <?php if ($_REQUEST["show"] == 50) { echo ' selected="selected"'; }  ?> >50</option>
							<option value="75" <?php if ($_REQUEST["show"] == 75) { echo ' selected="selected"'; }  ?> >75</option>
							<option value="100" <?php if ($_REQUEST["show"] == 100) { echo ' selected="selected"'; }  ?> >100</option>
						</select>
					</div>
				</div>
				<div class="col-md-10">
					<div class="dataTables_paginate paging_simple_numbers text-right">
						<ul class="pagination">
						<?php 
						echo $this->rppaginate_function($pagiArr[0],$pagiArr[1],$pagiArr[2],$pagiArr[3]); 
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	public function rppaginate_function($item_per_page, $current_page, $total_records, $total_pages)
	{
		
		$pagination = '';
		if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
			$right_links    = $current_page + 3; 
			$previous       = $current_page - 3; //previous link 
			$next           = $current_page + 1; //next link
			$first_link     = true; //boolean var to decide our first link

			if($current_page > 1){
				$previous_link = ($previous<=0)?1:$previous;
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="1" title="First">&laquo;</a></li>'; //first link
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
					for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
						if($i > 0){
							$pagination .= '<li class="paginate_button "><a href="#"  data-page="'.$i.'" aria-controls="datatable1" title="Page'.$i.'">'.$i.'</a></li>';
						}
					}   
				$first_link = false; //set first link to false
			}
			
			if($first_link){ //if current active page is first link
				$pagination .= '<li class="paginate_button active"><a aria-controls="datatable1">'.$current_page.'</a></li>';
			}elseif($current_page == $total_pages){ //if it's the last active link
				$pagination .= '<li class="paginate_button active"><a aria-controls="datatable1">'.$current_page.'</a></li>';
			}else{ //regular current link
				$pagination .= '<li class="paginate_button active"><a aria-controls="datatable1">'.$current_page.'</a></li>';
			}
			
			for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
				if($i<=$total_pages){
					$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
				}
			}

			if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
			}
		}
		return $pagination; //return pagination links
	}
	
}	
?>