<?php	
	include("connect.php");

	$ctable 	= 'product';
	$ctable1 	= 'Product';
	$main_page 	= 'product'; //for sidebar active menu
	$page		= 'product';
	$page_title = ucwords($_REQUEST['mode'])." ".$ctable1;

	$name = "";
	$stock = "";
	$price = "";

	if(isset($_REQUEST['submit']))
	{
		$name = $db->clean($_REQUEST['name']);
		$stock = $db->clean($_REQUEST['stock']);
		$price = $db->clean($_REQUEST['price']);

		$rows 	= array(
			'name' => $name,
			'stock' 	=> $stock,
			'price'		=> $price,
		);

		if(isset($_REQUEST['mode']) && $_REQUEST['mode']=="add")
		{
			$pid = $db->minsert($ctable, $rows);

			$_SESSION['MSG'] = 'Inserted';
			$db->rplocation(SITEURL.'manage-'.$page.'/');
			exit;
		}
		if(isset($_REQUEST['mode']) && $_REQUEST['mode']=="edit" && $_REQUEST['id'] != null)
		{
			$id = $_REQUEST['id'];
			$db->rpupdate($ctable, $rows, 'id='.$id);

			$_SESSION['MSG'] = 'Updated';
			$db->rplocation(SITEURL.'manage-'.$page.'/');
			exit;
		}
	}
	
	if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=='edit')
	{
		$where 	= 'id='.$_REQUEST['id'].' AND isDelete=0';
		$ctable_r = $db->rpgetData($ctable, '*', $where);
		$ctable_d = @mysqli_fetch_assoc($ctable_r);

		$name = stripslashes($ctable_d['name']);
		$stock = stripslashes($ctable_d['stock']);
		$price = stripslashes($ctable_d['price']);
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
												<div class="col-md-6">
													<div class="form-group">
														<label for="name">Name <code>*</code></label>
														<input maxlength="150" type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name" value="<?php echo $name; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="stock">Stock <code>*</code></label>
														<input type="number" class="form-control" name="stock" id="stock" placeholder="Enter Stock" value="<?php echo $stock; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="price">Price <code>*</code></label>
														<input type="number" class="form-control" name="price" id="price" placeholder="Enter Price" value="<?php echo $price; ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="card-footer">
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
				$("#frm").validate({
					ignore:"",
					rules: {
						name:{required:true},
						stock:{required:true},
						price:{ required:true},		
					},
					messages: {
						name:{required:"Please enter name."},
						stock:{required:"Please enter stock."},
						price:{required:"Please enter price."},
					},
					errorPlacement: function(error, element) {
						error.insertAfter(element);
					}

				});
			});
		</script>
	</body>
</html>

