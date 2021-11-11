	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
   <!-- plugins:js -->
	<script src="<?php echo SITEURL; ?>assets/vendors/js/vendor.bundle.base.js"></script>
	<!-- endinject -->
	<!-- Plugin js for this page -->
	<script src="<?php echo SITEURL; ?>assets/vendors/chart.js/Chart.min.js"></script>
	<!-- End plugin js for this page -->
	<!-- inject:js -->
	<script src="<?php echo SITEURL; ?>assets/js/off-canvas.js"></script>
	<script src="<?php echo SITEURL; ?>assets/js/hoverable-collapse.js"></script>
	<script src="<?php echo SITEURL; ?>assets/js/misc.js"></script>
	<!-- endinject -->
	<!-- Custom js for this page -->
	<script src="<?php echo SITEURL; ?>assets/js/dashboard.js"></script>
	<script src="<?php echo SITEURL; ?>assets/js/todolist.js"></script>

	<script src="<?php echo SITEURL; ?>assets/js/bootstrap-notify.js"></script>
	<script src="<?php echo SITEURL; ?>assets/js/jquery.validate.js"></script>

	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function(){
			<?php if(isset($_SESSION['MSG']) && $_SESSION['MSG'] == 'Something_Wrong') { ?>
				 $.notify({message: 'Something went wrong, Please try again!' },{type: 'danger'});
			<?php unset($_SESSION['MSG']); } else if(isset($_SESSION['MSG']) && $_SESSION['MSG'] == 'INVALID_DATA') { ?>
				 $.notify({message: 'Invalid data. Please enter valid data.' },{type: 'danger'});
			<?php unset($_SESSION['MSG']); } else if(isset($_SESSION['MSG']) && $_SESSION['MSG'] == 'Inserted') { ?>
				 $.notify({message: 'Record added successfully.' },{type: 'success'});
			<?php unset($_SESSION['MSG']); } else if(isset($_SESSION['MSG']) && $_SESSION['MSG'] == 'Updated') { ?>
				 $.notify({message: 'Record updated successfully.' },{type: 'success'});
			<?php unset($_SESSION['MSG']); } else if(isset($_SESSION['MSG']) && $_SESSION['MSG'] == 'Deleted') { ?>
				$.notify({message: 'Record deleted successfully.'},{type: 'success'});
			<?php unset($_SESSION['MSG']); } else if(isset($_SESSION['MSG']) && $_SESSION['MSG'] == 'Duplicate') { ?>
				$.notify({message: 'The record already exists. Please try another.'},{type: 'danger'});
			<?php unset($_SESSION['MSG']); } else if(isset($_SESSION['MSG']) && !empty($_SESSION['MSG'])) { ?>
				$.notify({message: '<?php echo $_SESSION['MSG']; ?>'},{type: 'danger'});
			<?php unset($_SESSION['MSG']); } 
			?>
			},1000);
		});

		function check_all()
		{
			var chk = $("#chkall").prop("checked");
			if( chk )
			{
				$(document).find('input[name="chkid[]"]').each(function() {
					$(this).prop('checked', true);
				});         
			}
			else
			{
				$(document).find('input[name="chkid[]"]').each(function() {
					$(this).prop('checked', false);
				});         
			}
		}

		function bulk_delete()
		{
			var flg = 0;
			$('input[name="chkid[]"]').each(function () {
			   if (this.checked) {
				   flg = 1;
				   //break; 
			   }
			});

			if( flg )
			{
				if( confirm("Are you sure you want to remove selected records?") )
				{
					$('#hdnmode').val('delete');
					$.ajax({
						url: "<?php echo SITEURL; ?>ajax_bulk_remove.php",
						type: "post",
						data : $('#frm').serialize(),
						success: function(response) {
							window.location.reload();
							//displayRecords(10,1);
						}
					});
				}
			}
			else
			{
				$.notify({message: "Please select at least one record."}, {type: "danger"});
				return false;
			}
			return false;
		}

		$('.num').keypress(function(event) {
			//alert(event.which);
			if( (event.which < 48 || event.which > 57) && event.which != 46)
				event.preventDefault();

			if( $(this).val().length >= 6 )
				event.preventDefault();
			else if( $(this).val() <= 0 && event.which == 48)
			{
				alert("Value cannot be zero.");
				return false;
			}
			else
			{
				if( (event.which < 48 || event.which > 57) && event.which != 46)
				   event.preventDefault();
			}
		});

	</script>