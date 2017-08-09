<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script language="javascript" type="text/javascript">  
$(document).ready(function(){

//let's create arrays
<?php
		$con=mysqli_connect("localhost","root","");
		mysqli_select_db($con,"cias");
        $query = mysqli_query($con, "SELECT branchId FROM tbl_branchs where isDeleted=0")or die("Error: ".mysqli_error($con));
		while($hasil=mysqli_fetch_array($query)){
			$id_cabang= $hasil['branchId'];
						   ?>
var a<?php echo $id_cabang ?> = [
	<?php
        $query1 = mysqli_query($con, "SELECT scheduleId, day, schedule FROM tbl_schedules where isDeleted=0 and branchId= '$id_cabang'")or die("Error: ".mysqli_error($con));
		while($hasil1=mysqli_fetch_array($query1)){
			$jadwal= $hasil1['day']." ".$hasil1['schedule'];
	?>
    {display: "<?php echo $jadwal ?>", value: "<?php echo $hasil1['scheduleId'] ?>" }, 
	<?php
		}
	?>
	];
<?php
		}
?>

//If parent option is changed
$("#branch").change(function() {
        var parent = $(this).val(); //get option value from parent 
        
        switch(parent){ //using switch compare selected option and populate child
		<?php
				$con=mysqli_connect("localhost","root","");
		mysqli_select_db($con,"cias");
        $query = mysqli_query($con, "SELECT branchId FROM tbl_branchs where isDeleted=0")or die("Error: ".mysqli_error($con));
		while($hasil=mysqli_fetch_array($query)){
						   ?>
              case '<?php echo $hasil['branchId'] ?>':
                list(a<?php echo $hasil['branchId'] ?>);
                break;
              <?php
		}
			  ?>
            default: //default child option is blank
                $("#schedule").html('');  
                break;
           }
});

//function to populate child select box
function list(array_list)
{
    $("#schedule").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options 
        $("#schedule").append("<option value="+array_list[i].value+">"+array_list[i].display+"</option>");
    });
}

});
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Management
        <small>Add</small>
      </h1>
    </section>
    
    <section class="content">
    <div class="row">
            <div class="col-xs-12 text-left">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>studentListing">Student Listing</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
           
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Student Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addStudent" action="<?php echo base_url() ?>addNewStudent" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name *</label>
                                        <input type="text" class="form-control required" id="fname" placeholder="John Doe" name="fname" >
                                    </div>
                                    
                                </div>
								<div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Parent Name *</label>
                                        <input type="text" class="form-control required" id="parent_name" placeholder="John Doe" name="parent_name" >
                                    </div>  
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Address *</label>
                                        <input type="text" class="form-control required" id="address" placeholder="Jl example" name="address" >
                                    </div>   
                                </div>
								
							</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Parent Phone Number *</label>
                                        <input type="text" class="form-control required digits" placeholder="08xxxxxxxx" id="mobile" name="mobile" minlength="10">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Parent Email *</label>
                                        <input type="text" class="form-control required email" id="email" placeholder="example@example.com" name="email" >
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Branch *</label>
                                        <select class="form-control required" id="branch" name="branch">
                                            <option value="0">Select Branch</option>
                                            <?php
                                            if(!empty($databranch))
                                            {
                                                foreach ($branch as $rl)
                                                {
													if($databranch!=1) {
														if($rl->branchId == $databranch){
														?>
														<option value="<?php if($rl->branchId == $databranch){echo $rl->branchId;} ?>" ><?php if($rl->branchId == $databranch) {echo $rl->name_branch; }?></option>
													   
														<?php
														}
													} else {
														?>
														<option value="<?php echo $rl->branchId; ?>" ><?php echo $rl->name_branch; ?></option>
													   
														<?php
													}
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Schedule *</label>
                                        <select class="form-control required" id="schedule" name="schedule">
                                            <option value="0">Schedule</option>
                                            
                                        </select>
                                    </div>
                                </div>  
							</div>
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Source *</label>
                                        <select class="form-control required" id="source" name="source">
                                            <option value="0">Source</option>
                                            <?php
                                            if(!empty($source))
                                            {
                                                foreach ($source as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->sourceId ?>"><?php echo $rl->source?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Age *</label>
                                        <input type="number" class="form-control required" id="age" placeholder="10" name="age">
                                    </div>
                                </div>
 							</div>	
							<div class="row">
								<div class="col-md-6">
								    <div class="form-group">
                                        <label>Class *</label>
                                        <input type="text" class="form-control required" id="class" placeholder="IX" name="class">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>School *</label>
                                        <input type="text" class="form-control required" id="school" placeholder="SD Kartini" name="school">
                                    </div>
                                </div>
 							</div>
							<div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="role">Status *</label>
                                        <select class="form-control required" id="status" name="status">
                                            <option value="0">Select Status</option>
                                            <?php
                                            if(!empty($status))
                                            {
                                                foreach ($status as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->statusId ?>"><?php echo $rl->status?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                  </div>
                              </div>
							</div>
						</div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
		</div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addStudent.js" type="text/javascript"></script>
