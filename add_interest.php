<?php 
	require_once(dirname(__FILE__).'/core/class.datamanager.php');
	require_once(dirname(__FILE__).'/core/class.validation.php');
	require_once(dirname(__FILE__).'/core/class.session.php');	
?>


<?php require_once(dirname(__FILE__).'/header.php');?>
<?php require_once(dirname(__FILE__).'/sidebar.php');?>	


	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?=$_PageTitle[basename($_SERVER['PHP_SELF'],'.php')];?>
			</h3>
			
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
		<?php  if(isset($_GET['edit'])){
					$id = $_GET['edit'];
					$key = datamanager::get_single_row('admin', array('id' => $id ));
			?>
			<!--start edit form-->
			<div class="form-actions fluid">
							<div class="row">
							<div class="col-md-offset-3 col-md-9">
														<button name="update" type="submit" class="btn blue">Update</button>														
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>

			<!--end edit form-->

			<?php }else{?>
			<!--start add form-->
<div class="portlet box yellow">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-gift"></i>Add Interest Payment
			</div>										
     		</div>
            <div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="" method="POST" name="interest_payment" class="form-horizontal">
											<div class="form-actions top">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<!--<button type="submit" class="btn green">Submit</button>-->
														<!--<button type="button" class="btn default">Cancel</button>-->
													</div>
												</div>
											</div>											
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Amount</label>
													<div class="col-md-4">
														<input type="text" name="amount" class="form-control" placeholder="Enter Amount">														
													</div>
												</div>
											</div>
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Month</label>
													<div class="col-md-4">
														<input type="text"  name="month" class="form-control" placeholder="Enter Month">														
													</div>
												</div>
											</div>	
											
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Date</label>
													<div class="col-md-4">
														<input type="date"  name="date" class="form-control" placeholder="Enter Date">																									
													</div>
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green"	onclick="this.value='Submitting ..';this.disabled='disabled'; this.form.submit();">Submit</button>
														<!--<button type="button" class="btn default">Cancel</button>-->
														<a href="interest_payment.php" class="btn default">Cancel</a>
													</div>
												</div>
											</div>
										</form>
										<?php
										if($_POST)
	{
	
	if(isset($_POST['amount']) && isset($_POST['month']) && isset($_POST['date']))
	{ 
	$amount=$_POST['amount'];
	$month=$_POST['month'];
	$date=$_POST['date'];
	echo $amnt=$amount+$amnt;
	
	define("DB_CONN","mysql:dbname=finance");
	define("DB_USERNAME","root");
	define("DB_PASSWORD","");
	$dbhi=new PDO(DB_CONN, DB_USERNAME, DB_PASSWORD);
	$token_id=md5(time());
$mysql_insert_rent = $dbhi->prepare("INSERT INTO `finance`.`interest_payment` 
(`amount`,`month`,`date`, `token_id`) 
VALUES 
('$amount','$month','$date','$token_id')");

$mysql_insert_rent->execute();
echo $amnt;


$particulars_type='Interest_Payment';
$mysql_insert_revenue_office = $dbhi->prepare("INSERT INTO `finance`.`revenue` 
(`particulars`,`debit`,`time`,`token_id`) 
VALUES 
('$particulars_type','$amount','$date','$token_id')");
$mysql_insert_revenue_office->execute();



	/* $mysql_insert_dealer = $dbhi->prepare("INSERT INTO dealer_payment 
	(id, amount, client_name, vehicle type, brand, model, price, purchase_date)
	VALUES (?, ?, ?, ?, ?, ?, ?,?)");
							
							$mysql_insert_dealer->execute(array(NULL,$amount,$client_name,$vehicle_type,$brand,$model,$price,$date)); */
							//$mysql_query1->execute(array(amount,client_name,vehicle_type,brand,model,price,date));
							header("location:interest_payment.php");
							
	} //isset
	} // if post
	?>
										<!-- END FORM-->
									</div>
								</div>
						<!--ends add form-->		

							<?php }?>
                            <?php //$query="SELECT SUM(amount) as 'total' FROM rent";
							
							define("DB_CONN","mysql:dbname=finance");
							define("DB_USERNAME","root");
							define("DB_PASSWORD","");
							$dbhi=new PDO(DB_CONN, DB_USERNAME, DB_PASSWORD);
							$query = "SELECT amount FROM interest_payment";
					$result = mysql_query($query);
								$sum = 0;
					while($row = mysql_fetch_assoc($result))
						{
    						$sum+= intval($row['amount']);	
						}

							//echo $sum;
							
							$q = mysql_query("SELECT SUM(amount) as sum FROM interest_payment WHERE amount > 0") or die(mysql_error());
							$row = mysql_fetch_assoc($q);
							echo $row['sum'];
							
							?>
                            <?php ?>
                            
                            <?php  
		
	
	if(isset($_POST['print_button'])){
		$field= $_POST['tr'];
		$field= explode(',',$field);
		
		$amt=0;
		foreach($field as $key){
				echo $key .'<br/>';
				
				$rnt = datamanager::get_single('interest_payment',array('id'=>$key),'interest_payment');
				$amt= $rnt + $amt;
				echo $amt;
				datamanager::save(array('interest_payment'=>$rnt),'revenue',array('id'=>1));
			}
		}
	
	
	?>

										
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
<?php require_once(dirname(__FILE__).'/quick_sidebar.php');?>	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		<?php echo date('Y')." &copy; ".SITE." | Developed by ".DEVELOPED;?> 
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>

<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/form-validation.js"></script>
<script src="process/search_ajax.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
FormValidation.init();
});
</script>
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->
</html>