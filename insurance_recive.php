<?php require_once(dirname(__FILE__).'/core/class.datamanager.php');?>
<?php require_once(dirname(__FILE__).'/header.php');?>
<?php require_once(dirname(__FILE__).'/sidebar.php');?>	
<?php
define("DB_CONN","mysql:dbname=finance");
define("DB_USERNAME","root");
define("DB_PASSWORD","");

							$dbhi=new PDO(DB_CONN, DB_USERNAME, DB_PASSWORD);
							
		if(isset($_GET['delete']) && isset($_GET['confirm']))
				{
					$delete_insurance_recive=$_GET['delete'];
					if($_GET['confirm'] == 'yes')
						{
							$sql5 = $dbhi->prepare("DELETE from insurance_recive WHERE id=$delete_insurance_recive");
							$sql5->execute();
							header("location:insurance_recive.php?data_succesfully_deleted");
							
						}
				}


/*
if($_POST)
{
echo 'test';
// UPDATE FUNCTION RUN HERE ###########################################################################
$dealer_name=$_POST['dealer_name'];
$client_name=$_POST['client_name'];
$vehicle_type=$_POST['vehicle_type'];
$brand=$_POST['brand'];
$model=$_POST['model'];
$price=$_POST['price'];
$date=$_POST['date'];

$sql3 = $dbhi->prepare("UPDATE dealer_payment SET dealer_name=$dealer_name, 
client_name=$client_name, vehicle type=$vehicle_type, brand=$brand, model=$model, price=$price, date=$date WHERE id=$get_edit");
	$sql3->execute();
	header("location:/finance/dealer_payment.php");
}				
*/							
											
							?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?=$_PageTitle[basename($_SERVER['PHP_SELF'],'.php')];?>
			</h3>
			
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 col-sm-12">					
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
							
								<i class="fa fa-user"></i>Insurance Recive Account 
								
							</div>
							<div align="right" style="padding:12px; font-weight:none; font-size:17px;"><a href="add_insurance_recive.php">ADD INSURANCE RECIVE ACCOUNT</a></div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="sample_2">
							<thead>
							<tr>
								<!--<th class="table-checkbox">
									<input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
									
								</th>-->
								<th></th>
								<th>ID</th>
                            	<th>Client Name</th>
								<th>Vehicle Type</th>
                                <th>Vehicle Brand</th>
								<th>Vehicle Model</th>
                                <th>Registration No</th>
                                <th>Chasis No</th>
                                <th>Premium Year</th>
                                <th>Amount Paid</th>
                                <th>Date</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
						<?php   
						
						// NEW DATA INSERT
						
						
		
		
						
						//NEW DATA INSERT
						
						
						
						
						//$data = datamanager::get_allx("dealer_payment");
							//foreach ($data as $key ):
							
							



/*------------------------------------------------------DELETE FUNCTION RUN HERE----------------------*/




if(isset($_GET['delete']) && !isset($_GET['edit']))
$delete_insurance_recive=$_GET['delete'];
{
							
							$sql4 = $dbhi->prepare("SELECT * FROM  insurance_recive WHERE id=$delete_insurance_recive");
									
							$sql4->execute();
							
							
							for($i=0; $key3 = $sql4->fetch(); $i++)
						{
						
						
						
							?>	
							
							<tr class="odd gradeX">
							<!--<td><input type="checkbox" class="checkboxes" value="<?php echo $key3['id'];?>"/></td>-->
								<td><?php // echo $key3['id'];?></td>
								<td><?php echo $key3['id'];?></td>
                                <td><?php echo $key3['client_name'];?></td>
                                <td><?php echo $key3['vehicle_type'];?></td>
                                <td><?php echo $key3['vehicle_brand'];?></td>
                            	<td><?php echo $key3['vehicle_model'];?></td>
								<td><?php echo $key3['reg_no'];?></td>	
								<td><?php echo $key3['chasis_no'];?></td>
                                <td><?php echo $key3['premium_year'];?></td>
                                <td><?php echo $key3['amount_paid'];?></td>
								<td><?php echo $key3['date'];?></td>	
								<!-- <td> -->
									<td>
										<div class="btn-toolbar margin-bottom-10">
														<div class="btn-group btn-group-sm btn-group-solid">															
												<a href="<?php echo $_SERVER['PHP_SELF']."?delete=".$key3['id'].'&confirm=yes';?>" class="btn green">CONFIRM</a>
															<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn red">CANCEL</a>
														</div>
													</div>
							</td>
							</form>
				 <?php 
				 					
				 } //for loop end
				 
				 } // if isset delete




/*--------------------------------------------DELETE FUNCTION END HERE-----------------------------------*/









							
if(isset($_GET['edit']) && !isset($_GET['delete']))
{
// EDIT FUNCTION ######################################################################
$get_edit_id=$_GET['edit'];
	header("location:edit_insurance_recive.php?id=$get_edit_id");
?>





		<form name="edit_insurance_recive" id="edit_insurance_recive" method="POST" novalidate="novalidate" action="<?php  echo $_SERVER['PHP_SELF']."?edit=".$key3['id'];?>">
<?php		


$get_edit=$_GET['edit'];
$sql2 = $dbhi->prepare("SELECT * FROM  insurance_recive WHERE id=$get_edit");
	$sql2->execute();
							
	
							for($i=0; $key3 = $sql2->fetch(); $i++)
						{
						?>	

							<tr class="odd gradeX">
								<td><input style="new_input_text" type="checkbox" class="checkboxes" value="<?php echo $key3['id'];?>"/></td>
                                <td><input class="new_input_text" type="text" name="client_name" value="<?php echo $key3['client_name'];?>"/></td>
                                <td><input class="new_input_text" type="text" name="vehicle_type" value="<?php echo $key3['vehicle_type'];?>"/></td>
                                <td><input class="new_input_text" type="text" name="vehicle_brand" value="<?php echo $key3['vehicle_brand'];?>"/></td>
                                <td><input class="new_input_text" type="text" name="vehicle_model" value="<?php echo $key3['vehicle_model'];?>"/></td>
                                <td><input class="new_input_text" type="text" name="reg_no" value="<?php echo $key3['reg_no'];?>"/></td>
								<td><input class="new_input_text" type="text" name="chasis_no" value="<?php echo $key3['chasis_no'];?>"/></td>
                                <td><input class="new_input_text" type="text" name="premium_year" value="<?php echo $key3['premium_year'];?>"/></td>
								<td><input class="new_input_text" type="text" name="amount_paid" value="<?php echo $key3['amount_paid'];?>"/></td>
								<td><input type="date" name="date" value="<?php echo $key3['date'];?>"/></td>	
								<!-- <td> -->
									<td>
										<div class="btn-toolbar margin-bottom-10">
														<div class="btn-group btn-group-sm btn-group-solid">	
										<input type="submit" name="save" value="SAVE" class="btn green" />
															<!--<a href="<?php //echo$_SERVER['PHP_SELF']."?save=".$key3['id'];?>" class="btn green">SAVE</a>-->
															<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn red">CANCEL</a>
														</div>
													</div>
									</td>
									
									
				 <?php 
			 					
				 } //for loop end
				 
			echo	 '</form>';	
				 
}
if(!isset($_GET['delete']) && !isset($_GET['edit']))
{
							
							$sql2 = $dbhi->prepare("SELECT * FROM  insurance_recive  ORDER BY `id` DESC");
									
							$sql2->execute();
							
							
							for($i=0; $key3 = $sql2->fetch(); $i++)
						{
						
						
						
							?>	
							
							<tr class="odd gradeX">
								<!--<td><input type="checkbox" class="checkboxes" value="<?php echo $key3['id'];?>"/></td>-->
								<td><?php // echo $key3['id'];?></td>
								<td><?php echo $key3['id'];?></td>
                                <td><?php echo $key3['client_name'];?></td>
                                <td><?php echo $key3['vehicle_type'];?></td>
                                <td><?php echo $key3['vehicle_brand'];?></td>
                            	<td><?php echo $key3['vehicle_model'];?></td>
								<td><?php echo $key3['reg_no'];?></td>	
								<td><?php echo $key3['chasis_no'];?></td>
                                <td><?php echo $key3['premium_year'];?></td>
                                <td><?php echo $key3['amount_paid'];?></td>
								<td><?php echo $key3['date'];?></td>	
								<!-- <td> -->
									<td>
										<div class="btn-toolbar margin-bottom-10">
														<div class="btn-group btn-group-sm btn-group-solid">															
															<a href="<?php echo$_SERVER['PHP_SELF']."?edit=".$key3['id'];?>" class="btn green">EDIT</a>
															<a href="<?php echo$_SERVER['PHP_SELF']."?delete=".$key3['id'];?>" class="btn red">DELETE</a>
														</div>
													</div>
							</td>
							</form>
				 <?php 
				 					
				 } //for loop end
				 } //else
				 //-------------------------------------TEMP-------------------------------------------------
				 //echo $key['scheme'];
							//$paid =  datamanager::count("Select * FROM dealer_payment where client_id =".$key['id']." AND status = 1");
							//$unpaid =  datamanager::count("Select * FROM dealer_payment where client_id =".$key['id']." AND status = 0");
							//$penalty = datamanager::count("Select * FROM dealer_payment where client_id =".$key['id']." AND penalty > 1 AND status = 0"); 

							//if($penalty >0){
							//	echo '<span class="label label-md label-danger"> Over Due </span>';
							//}elseif($unpaid <= 0 || $paid == $key['scheme']){
							//	echo '<span class="label label-md label-success"> Cleared </span>';
							//}else{
								//echo '<span class="label label-md label-warning"> UnPaid </span>';
							//}
//-------------------------------------------------------TEMP-------------------------------------------------------------
							?>

								<!-- </td> -->
								<!-- <td><a class="btn btn-circle btn-sm blue-stripe" href="dealer_payment.php?id=<?=$key['id'];?>" >VIEW<span class="glyphicon glyphicon-user"></span></a></td> -->
										
							</tr>
						<?php 
						//} 
						// for loop
						//endforeach;
						?>
							</tbody>
							</table>
						</div>
					</div>			
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
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="assets/admin/pages/scripts/table-managed.js"></script>
<script src="assets/admin/pages/scripts/form-validation.js"></script>
<script src="process/search_ajax.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
 TableManaged.init();
 FormValidation.init();
 
  $.ajax({
        url: "process/edit_dealer_process.php",    
        type: "POST",                   
        data: data,      
        contentType: false,             
        cache: false,                  
        processData:false,              
        success: function(data)         
        {
            alert(data);                   
        }, 
        error: function(XMLHttpRequest, textStatus, errorThrown) {
                         alert("Error Occur");
                      }          
   });  
/*ends ajax*/
 
 
});
</script>
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->
</html>

