<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Management
        <small>Add</small>
      </h1>
    </section>
    
    <section class="content">
    <div class="row">
            <div class="col-xs-12 text-left">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>paymentListing">Payment Listing</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->         
                
            <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Payment Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addPayment" action="<?php echo base_url() ?>addNewPayment" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="student_name">Student Name *</label>
                                        <input type="text" class="form-control required" placeholder="John Doe" id="student_name" name="student_name">
                                    </div>
                                </div>
                            </div>
							<div class="row">
								  <div class="col-md-12">
									  <div class="form-group">
										  <label for="point">Nominal *</label>
										  <input type="number" class="form-control required" placeholder="550000" id="nominal" name="nominal">
									  </div>
								  </div>
							</div>
                            
							<div class="row">
							  <div class="col-md-12">
								  <div class="form-group">
									  <label for="group_project">Note</label>
									  <input type="text" class="form-control" id="note" placeholder="Pembayaran HOC" name="note">
								  </div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-12">
								  <div class="form-group">
										  <label for="unplugged">Method *</label>
										  <input type="text" class="form-control required" id="method" placeholder="Cash" name="method" >
									  </div>
								  </div>
                			</div>
							<div class="row">
							  <div class="col-md-12">
								<div class="form-group">
								  <label for="allocation">Allocation *</label>
								  <input type="text" class="form-control required" id="allocation" value="4" name="allocation" >
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
