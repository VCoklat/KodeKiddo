<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedule Management
        <small>Add</small>
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
                    
                    <form role="form" id="addSchedule" action="<?php echo base_url() ?>addNewSchedule" method="post" role="form">
                        <div class="box-body">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="day">Day *</label>
                                      <select class="form-control required" id="day" name="day">
                                              <option value="Monday ">Monday</option>
                                              <option value="Tuesday ">Tuesday</option>
                                              <option value="Wednesday ">Wednesday</option>
                                              <option value="Thursday ">Thursday</option>
                                              <option value="Friday ">Friday</option>
                                              <option value="Saturday ">Saturday</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="fname">Time *</label>
                                      <input type="text" class="form-control required" placeholder="14.00-18.00" id="fname" name="fname">
                                  </div>
                              </div>
                          </div>
							<div class="row">
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Branch *</label>
                                        <select class="form-control required" id="branch" name="branch">
                                            <!--option value="0">Select Branch</option-->
											<?php
											if($databranch==1)
                                            {
                                                foreach ($branch as $rl)
                                                {
													
                                                    ?>
													<option value="<?php echo $rl->branchId; ?>" ><?php echo $rl->name_branch; ?></option>
                                                   
                                                    <?php
													
                                                }
                                            } else
											{
												foreach ($branch as $rl)
                                                {
													if($rl->branchId == $databranch){
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
<script src="<?php echo base_url(); ?>assets/js/addSchedule.js" type="text/javascript"></script>