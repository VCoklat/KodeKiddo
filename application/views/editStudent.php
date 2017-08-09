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
			$jadwal= $hasil1['day'].$hasil1['schedule'];
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

<?php

$studentId = '';
$name = '';
$mobile = '';
$branch = '';
$parent_name = '';
$parent_email = '';
$branch_id = '';
$address = '';
$source = '';
$schedule = '';
$age = '';
$class = '';
$school = '';
$status = '';

if(!empty($studentInfo))
{
    foreach ($studentInfo as $uf)
    {
        $studentId = $uf->studentId;
        $name = $uf->name;
        $mobile = $uf->mobile;
		$parent_name = $uf->parent_name;
		$parent_email = $uf->parent_email;
		$branch_id = $uf->branchId;
		$address = $uf->address;
		$source = $uf->source;
		$age = $uf->age;
		$schedule = $uf->scheduleId;
		$class = $uf->kelas;
		$school = $uf->school;
		$status = $uf->status;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Management
        <small>Edit Student</small>
      </h1>
    </section>
    
    <section class="content">
		<div class="row">	
    			<div class="col-xs-4 text-left">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">History Payment & Attedance</button>
                </div>
            </div>
			
			<div class="col-xs-4 text-center">
                <div class="form-group"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#expenseModal">Make Point Expense</button>
                </div>
            </div>
			
			<div class="col-xs-4 text-right">
                <div class="form-group"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statushistory">Status History</button>
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
                    
                    <form role="form" action="<?php echo base_url() ?>editStudent" method="post" id="editStudent" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name *</label>
                                        <input type="text" class="form-control required" id="fname" name="fname" value="<?php echo $name; ?>">
										<input type="hidden" value="<?php echo $studentId; ?>" name="studentId" id="studentId" />
                                    </div>
                                    
                                </div>
								<div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Parent Name *</label>
                                        <input type="text" class="form-control required" id="parent_name" name="parent_name" value="<?php echo $parent_name; ?>">
                                    </div>
                                    
                                </div>
                                
                            </div>
							<div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Address *</label>
                                        <input type="text" class="form-control required" id="address" name="address"value="<?php echo $address; ?>" >
                                    </div>   
                                </div>
								
							</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Parent Phone Number *</label>
                                        <input type="text" class="form-control required digits" id="mobile" name="mobile" minlength="10" value="<?php echo $mobile; ?>">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Parent Email *</label>
                                        <input type="text" class="form-control required email" id="email"  name="email"  value="<?php echo $parent_email; ?>">
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
                                            if(!empty($branches))
                                            {
                                                foreach ($branches as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->branchId; ?>" <?php if($rl->branchId == $branch_id) {echo "selected=selected";} ?>><?php echo $rl->name_branch ?></option>
                                                    <?php
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
                                            
                                            <?php
                                            if(!empty($jadwal1))
                                            {
                                                foreach ($jadwal1 as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->scheduleId; ?>" <?php if($rl->scheduleId == $schedule) {echo "selected=selected";} ?>><?php echo $rl->day.$rl->schedule ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
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
                                            if(!empty($sources))
                                            {
                                                foreach ($sources as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->sourceId; ?>" <?php if($rl->sourceId == $source) {echo "selected=selected";} ?>><?php echo $rl->source ?></option>
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
                                        <input type="number" class="form-control required" id="age"  name="age" value="<?php echo $age; ?>">
                                    </div>
                                </div>
 							</div>	
							<div class="row">
								<div class="col-md-6">
								    <div class="form-group">
                                        <label>Class *</label>
                                        <input type="text" class="form-control required" id="class"  name="class" value="<?php echo $class; ?>">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>School *</label>
                                        <input type="text" class="form-control required" id="school"  name="school" value="<?php echo $school; ?>">
                                    </div>
                                </div>
 							</div>
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Status *</label>
                                        <select class="form-control" id="status" name="status">
                                            <!--option value="0">Select Branch</option-->
                                            <?php
                                            if(!empty($status_data))
                                            {
                                                foreach ($status_data as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->statusId; ?>" <?php if($rl->statusId == $status) {echo "selected=selected";} ?>><?php echo $rl->status ?></option>
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
	
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">History List</h4>
        </div>
       <div class="modal-body">
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->       
                <div class="box box-primary">
                                    <div class="box-header">
                    <h3 class="box-title">Absents List For </h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table-absent">
                    <thead>
					<tr>
                      <th>No</th>
                      <th>Student Name</th>
					  <th>Date</th>
					  <th>Is Paid?</th>
					  <th>Absent</th>
					  <th>Teacher Note</th>
					  <th>Milestone</th>
					  <th>Online</th>
					  <th>Unplugged</th>
					  <th>Group Project</th>                
					  <th>Point</th>  
					  
                    </tr>
					</thead>
					
					<tbody>
					
                    <?php
                    if(!empty($absentRecords))
                    {
                      $number=0;
                        foreach($absentRecords as $record)
                        {
							$number++;
                    ?>
                    <tr >				  
                      <td><?php echo $number ?></td>
                      <td><?php echo $record->Student_name; 
					  $nama = $record->Student_name;
						$con = mysqli_connect('localhost', 'root', '');
						mysqli_select_db($con,"cias");
						$no = 1;
							
						$query = mysqli_query($con, "SELECT studentId FROM tbl_students WHERE name= '$nama' ;")or die("Error: ".mysqli_error($con));
						while($hasil=mysqli_fetch_array($query)){
							$id1 = $hasil['studentId'];
						}	?></td>
						
                      <td><?php echo $record->date; ?></td>
					  
					  <td><?php 
					  $query = mysqli_query($con, "SELECT total_attedance, total_paid FROM tbl_students WHERE name= '$nama' ;")or die("Error: ".mysqli_error($con));
						while($result=mysqli_fetch_array($query))
					 {
						 $attedance= $result['total_attedance'];
						 $paid= $result['total_paid'];
						 if ($attedance>$paid)	 echo "NO"; else echo "YES";
						 
					 }
					  ?></td>
					  <td><?php if ($record->absent==0) echo "NO"; else echo "YES"; ?></td>
					  <td><?php echo $record->teacher_note ?></td>
					  <td><?php echo $record->milestone ?></td>
					  <td><?php echo $record->online ?></td>
					  <td><?php echo $record->unplugged ?></td>
					  <td><?php echo $record->group_project ?></td>
                      
					  <td><?php echo $record->point ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
					</tbody>
                  </table>

                </div><!-- /.box-body -->
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
 
        </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	</div>
	
	<div class="modal fade" id="expenseModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
       <div class="modal-body">
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->       
                <div class="box box-primary">
                                    <div class="box-header">
                    <h3 class="box-title">Student Expense </h3>
                    <!--div class="box-tools">
                        <form action="<?php echo base_url() ?>absentListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div-->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table-absent">
                    <thead>
					<tr>
                      <th>No</th>
                      <th>Student Name</th>
					  <th>Point</th>
					  <th>Note</th>
					  <th>Date</th>					  
                    </tr>
					</thead>
					
					<tbody>
					
                    <?php
                    if(!empty($expenseRecords))
                    {
                      $number=0;
                        foreach($expenseRecords as $record)
                        {
							$number++;
                    ?>
                    <tr>				  
                      <td><?php echo $number ?></td>
                      <td><?php echo $record->name ?></td>                    
                      <td><?php echo $record->nominal ?></td>
					  <td><?php echo $record->note?></td>
					  <td><?php echo $record->createdDate ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
					</tbody>
                  </table>

                </div><!-- /.box-body -->
                      </div>
            </div>
           
        </div>          
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                              
                <div class="box box-primary">                    
                    <form role="form" action="<?php echo base_url() ?>expenseStudent" method="post" id="expenseStudent" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Point *</label>
                                        <input type="text" class="form-control required" id="nominal" name="nominal" >
																				
										<input type="hidden" value="<?php echo $studentId; ?>" name="studentId" id="studentId" />
                                    </div>
                                    
                                </div>
								<div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Note *</label>
                                        <input type="text" class="form-control required" id="note" name="note" placeholder="Penukaran dengan kartu Uno">
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
        </div>    
    
        </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	</div>	
	
	<div class="modal fade" id="statushistory" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Status History</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->       
                <div class="box box-primary">
                                    <div class="box-header">
                    <h3 class="box-title">Status Movement </h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table-absent">
                    <thead>
					<tr>
                      <th>No</th>
                      <th>Student Name</th>
					  <th>status</th>
					  <th>Created By</th>
					  <th>Date</th>					  
                    </tr>
					</thead>
					
					<tbody>
					
                    <?php
                    if(!empty($statusRecords))
                    {
                      $number=0;
                        foreach($statusRecords as $record)
                        {
							$number++;
                    ?>
                    <tr>				  
                      <td><?php echo $number ?></td>
                      <td><?php echo $record->name ?></td>                    
                      <td><?php $record->new_status ;
					  $status = $record->new_status;
						$con = mysqli_connect('localhost', 'root', '');
						mysqli_select_db($con,"cias");
						$no = 1;
							
						$query = mysqli_query($con, "SELECT status FROM tbl_status WHERE statusId= '$status' ;")or die("Error: ".mysqli_error($con));
						while($hasil=mysqli_fetch_array($query)){
							$status = $hasil['status'];
						}
						echo $status
					?></td>
					  <td><?php
						$nama = $record->createdBy;
						$con = mysqli_connect('localhost', 'root', '');
						mysqli_select_db($con,"cias");
						$no = 1;
							
						$query = mysqli_query($con, "SELECT name FROM tbl_users WHERE userId= '$nama' ;")or die("Error: ".mysqli_error($con));
						while($hasil=mysqli_fetch_array($query)){
							$name = $hasil['name'];
						}
						echo $name
						?></td>
					  <td><?php echo $record->createdDate ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
					</tbody>
                  </table>

                </div><!-- /.box-body -->
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
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	</div>
	
</div>

<script src="<?php echo base_url(); ?>assets/js/editStudent.js" type="text/javascript"></script>