<?php	
	include("connect.php");

	$ctable 	= 'sales';
	$ctable1 	= 'Sales';
	$main_page 	= 'sales'; //for sidebar active menu
	$page		= 'sales';
	$page_title = ucwords($_REQUEST['mode'])." ".$ctable1;

	if(isset($_REQUEST['submit']))
	{
		//print_r($_REQUEST); exit;

		$product_id = $_REQUEST['product_id'];
		$qty = $_REQUEST['qty'];

		$rows = array('total' => 0);
		$sales_id = $db->minsert($ctable, $rows);

		//$db->rpdelete('sales_item', 'sales_id=' . $sales_id);
		$n = count($product_id);

		$total = 0;
		for($i=0; $i<$n; $i++)
		{
			$price = $db->rpgetValue('product', 'price', 'id='.$product_id[$i]);
			$rows = array(
					'sales_id' => (int) $sales_id,
					'product_id' => (int) $product_id[$i],
					'qty' => (int) $qty[$i],
					'price' => (float) $price,
				);
			$db->minsert('sales_item', $rows);
			$total += ($qty[$i] *  $price);
		}

		$rows = array('total' => $total);
		$db->rpupdate($ctable, $rows, 'id='.$sales_id);

		$_SESSION['MSG'] = 'Inserted';
		$db->rplocation(SITEURL.'manage-'.$page.'/');
		exit;
	}
	
	if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="delete")
	{
		$id = $_REQUEST['id'];
		$rows = array('isDelete' => '1');
		
		$db->rpupdate($ctable, $rows, 'id='.$id);
		
		$_SESSION['MSG'] = 'Deleted';
		$db->rplocation(SITEURL.'manage-'.$page.'/');
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $page_title . ' | ' . ADMINTITLE; ?></title>
		<?php include('include/css.php'); ?>
	</head>

	<body>
		<div class="container-scroller">
			<?php include("include/header.php"); ?>
			<div class="container-fluid page-body-wrapper">
				<?php include("include/left.php"); ?>
				<div class="main-panel">
					<div class="content-wrapper">
						<div class="page-header">
							<h3 class="page-title">
							<span class="page-title-icon bg-gradient-info text-white mr-2">
								<i class="mdi mdi-format-list-bulleted"></i>
							</span> <?php echo $page_title; ?> </h3>
						</div>
						<div class="row">
							<div class="col-md-12 grid-margin stretch-card">
								<div class="card">
							    	<form class="forms-sample" role="form" name="frm" id="frm" action="." method="post" enctype="multipart/form-data">
										<input type="hidden" name="mode" id="mode" value="<?php echo $_REQUEST['mode']; ?>">
										<input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>">
								    	<div class="card-body">
								    		<div class="row">
								    			<div class="col-md-4">
								    				<label for="name">Product</label>
								    			</div>
								    			<div class="col-md-4">
								    				<label for="qty">Quantity</label>
								    			</div>
								    			<div class="col-md-4">
								    				<label for="price">Remove</label>
								    			</div>
								    		</div>
								    		<div id="divcontent">
												<div class="row" id="row_1">
													<div class="col-md-4">
														<div class="form-group">
															<select name="product_id[]" id="product_id" class="form-control">
															<?php
																$rs_p = $db->rpgetData('product', 'id, name', 'isDelete=0', 'name');
																while( $row_p = @mysqli_fetch_assoc($rs_p) )
																{
																	echo '<option value="'.$row_p['id'].'">' . $row_p['name'] . '</option>';
																}
															?>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<input type="number" name="qty[]" id="qty" class="form-control" placeholder="Enter Quantity" value="<?php echo $qty; ?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<button type="button" onclick="remove_button(1)" class="btn btn-danger"><i class="mdi mdi-minus"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card-footer">
											<input type="hidden" name="hdncounter" id="hdncounter" value="1">
											<button type="button" id="add_button" class="btn btn-info"><i class="mdi mdi-plus"></i></button>
											<button type="submit" name="submit" id="submit" title="Submit" class="btn btn-gradient-success btn-icon-text"><i class="mdi mdi-content-save-all"></i> </button>
											<button type="button" title="Back" class="btn btn-gradient-danger btn-icon-text" onClick="window.location.href='<?php echo SITEURL; ?>manage-<?php echo $page; ?>/'"><i class="mdi mdi-step-backward"></i> </button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php include("include/footer.php"); ?>
				</div>
			</div>
		</div>

		<?php include('include/js.php'); ?>
		<script type="text/javascript">
			$(function(){
			   	$('#add_button').click(function(){
			   		val = $("#hdncounter").val();
			   		val++;
			   		//alert(val);
			   		$("#hdncounter").val(val);
			   		$("#divcontent").append(`
						<div class="row" id="row_`+val+`">
							<div class="col-md-4">
								<div class="form-group">
									<select name="product_id[]" id="product_id" class="form-control">
									<?php
										$rs_p = $db->rpgetData('product', 'id, name', 'isDelete=0', 'name');
										while( $row_p = @mysqli_fetch_assoc($rs_p) )
										{
											echo '<option value="'.$row_p['id'].'">' . $row_p['name'] . '</option>';
										}
									?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="qty[]" id="qty" class="form-control" placeholder="Enter Quantity" value="">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<button type="button" onclick="remove_button(`+val+`)" class="btn btn-danger"><i class="mdi mdi-minus"></i></button>
								</div>
							</div>
						</div>
			   		`);
			   	});
			});

		   	function remove_button(id)
		   	{
		   		if( confirm('Are you sure?') )
		   		{
		   			$('#row_'+id).remove();
		   		}
		   	}
		</script>
	</body>
</html>

