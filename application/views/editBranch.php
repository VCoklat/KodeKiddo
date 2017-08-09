<?php


$name = '';

$mobile = '';
$branchId = '';
$address = '';
$info = '';

if(!empty($branchInfo))
{
    foreach ($branchInfo as $uf)
    {
        $name = $uf->name_branch;
		$branchId = $uf->branchId;
        $mobile = $uf->phone;
        $info = $uf->info;
		$address = $uf->address;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Branch Management
        <small>Edit Branch</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Branch Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editBranch" method="post" id="editBranch" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Branch Name *</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" placeholder="Gading Serpong" value="<?php echo $name; ?>" >
                                        <input type="hidden" value="<?php echo $branchId; ?>" name="branchId" id="branchId" />    
                                    </div>    
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Phone Number *</label>
                                        <input type="text" class="form-control required" id="mobile" placeholder="021xxxxxxx" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>">
                                    </div>
                                </div>
                            </div>
                           
							<div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label>Address *</label>
                                        <input type="text" class="form-control required" placeholder="Jl example" id="address" name="address" value="<?php echo $address; ?>">
                                    </div>  
                                </div>
							</div>
							<div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label >Information</label>
                                        <input type="text" class="form-control required" id="info" placeholder="info@kodekiddo.com" name="info" value="<?php echo $info; ?>">
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

<script src="<?php echo base_url(); ?>assets/js/editBranch.js" type="text/javascript"></script>