<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Absent Management
        <small>Show</small>
      </h1>
    </section>
    
    <section class="content">
	<div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addAbsent">Add New Absent</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->         
                
            <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Absent Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="report" action="<?php echo base_url() ?>showreport" method="post" role="form">
                        <div class="box-body">
                            <p>Choose Date: *<input type="text" id="datepicker" name="datepicker"></p>
                            <!--div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="class">Class</label>
                                      <select class="form-control required" id="class_schedule" name="class_schedule">
                                          <option value="0">Select Class</option>
                                          <?php
                                          if(!empty($class))
                                          {
                                              foreach ($class as $rl)
                                              {
                                                  ?>
                                                  <option value="<?php echo $rl->scheduleId ?>"><?php echo $rl->schedule ?></option>
                                                  <?php
                                              }
                                          }
                                          ?>
                                      </select>
                                    </div>
                                </div>
                            </div-->
                            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />

                            <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
                            <script type="text/javascript">

                            var $j = jQuery.noConflict();
                            $(function() {
                            $j( "#datepicker" ).datepicker();
                            });
                              $(function () {
            										$("#chkPassport").click(function () {
            											if ($(this).is(":checked")) {
            												$("#dvPassport").hide();
            											} else {
            												$("#dvPassport").show();
            											}
            										});
            									});
            				</script>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </form>
                </div>
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
    </section>
    
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var availableTags = [
	<?php
		$con=mysqli_connect("localhost","root","");
		mysqli_select_db($con,"cias");
		if ($databranch != 1){
			$query = mysqli_query($con, "SELECT name FROM tbl_students where branchId='$databranch' and isDeleted=0 and ScheduleId!=0");
		} else {
			$query = mysqli_query($con, "SELECT name FROM tbl_students where isDeleted=0 and ScheduleId!=0");
		}
		while($hasil=mysqli_fetch_array($query)){		
	?>
      "<?php echo $hasil['name'] ?>",
      <?php
	    }
	  ?>
    ];
    $( "#student_name" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
