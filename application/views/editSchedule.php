<?php

$scheduleId = '';
$day = '';
$schedule = '';
$branchId = '';

if(!empty($scheduleInfo))
{
    foreach ($scheduleInfo as $uf)
    {
        $scheduleId = $uf->scheduleId;
        $day = $uf->day;
        $time = $uf->schedule;
		$branchId = $uf->branchId;
    }
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedule Management
        <small>Edit</small>
      </h1>
    </section>
    
    <section class="content">
    <div class="row">
            <div class="col-xs-12 text-left">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>scheduleListing">Schedule Listing</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Schedule Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="editSchedule" action="<?php echo base_url() ?>editSchedule" method="post" role="form">
                        <div class="box-body">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="day">Day *</label>
                                      <select class="form-control required" id="day" name="day">
											  <option value="<?php echo $day?>"><?php echo $day?></option>
                                              <option value="Monday ">Monday</option>
                                              <option value="Tuesday ">Tuesday</option>
                                              <option value="Wednesday ">Wednesday</option>
                                              <option value="Thursday ">Thursday</option>
                                              <option value="Friday ">Friday</option>
                                              <option value="Saturday ">Saturday</option>
                                      </select>
                                  </div>
                              </div>
							  <input type="hidden" value="<?php echo $scheduleId; ?>" name="scheduleId" id="scheduleId" />  
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="fname">Time *</label>
                                      <input type="text" class="form-control required" placeholder="14.00-18.00" id="fname" name="fname" value=<?php echo $time; ?>>
                                  </div>
                              </div>
                          </div>
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Branch *</label>
                                        <select class="form-control" id="branch" name="branch">
                                            <option value="0">Select Branch</option>
                                            <?php
                                            if(!empty($branch))
                                            {
                                                foreach ($branch as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->branchId; ?>" <?php if($rl->branchId == $branchId) {echo "selected=selected";} ?>><?php echo $rl->name_branch ?></option>
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

<script src="<?php echo base_url(); ?>assets/js/editSchedule.js" type="text/javascript"></script>