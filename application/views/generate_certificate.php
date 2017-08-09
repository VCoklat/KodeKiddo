
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Certificate Generator
        <small>Add</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Ceritificate Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Certificate For</label>
                                        <select class="form-control required" id="choose" name="choose">
											<option value="0">Select Certificate</option>
											<option value="1">HOC</option>
											<option value="2">MileStone</option>
                                        </select>
                                    </div>
                                </div
							</div>
						</div>
					</div>
					<form role="form" style='display:none;' id="HOC" action="<?php echo base_url() ?>generate" method="post" role="form">
					<div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Choose Student *</label>
									<br>
					<?php
                        if(!empty($certificateRecords))
                        {
                            foreach ($certificateRecords as $rl)
                            {
                                ?>
								<input type="checkbox" name="name[]" id="name" value="<?php echo $rl->studentId ?>"> <?php echo $rl->name ?><br>
              
                                <?php
                            }
                        }
						
					?>
								</div>
							</div>
						</div>	
					
						<div class="row">
						    <div class="col-md-12">
								<div class="form-group">
								  <label for="teacher_note">Teacher Note</label>
								  <input type="text" class="form-control" id="milestone" placeholder="Student blabla"  name="milestone" >
								</div>
							  </div>
						</div>	
					</div>	
					<div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
					</form>
					
                    <form role="form" style='display:none;' id="milestone1" action="<?php echo base_url() ?>generate" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Full Name *</label>
                                        <select class="form-control required" id="name" name="name">
                                            
                                            <?php
                                            if(!empty($certificateRecords))
                                            {
                                                foreach ($certificateRecords as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->studentId ?>"><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
                            </div>
							<div class="row">
								<div class="col-md-2">
								  <div class="form-group">
									<label for="teacher">MileStone</label>
									<select class="form-control" id="milestone" name="milestone">
										<option value="-">-</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
								  </div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-12">
								<div class="form-group">
								  <label for="teacher_note">Teacher Note</label>
								  <input type="text" class="form-control" id="teacher_note" placeholder="Student blabla"  name="teacher_note" >
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
<script>
$(document).ready(function(){
    $('#choose').on('change', function() {
      if ( this.value == '2')
      //.....................^.......
      {
        $("#milestone1").show();
		$("#HOC").hide();
      }
      else
      {
        $("#milestone1").hide();
		$("#HOC").show();
      }
    });
});
</script>