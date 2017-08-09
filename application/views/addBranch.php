<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Branch Management
        <small>Add</small>
      </h1>
    </section>
    
    <section class="content">
    <div class="row">
            <div class="col-xs-12 text-left">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>branchListing">Branch Listing</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->         
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Branch Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addBranch" action="<?php echo base_url() ?>addNewBranch" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Branch Name *</label>
                                        <input type="text" class="form-control required" placeholder="Permata Buana" id="fname" name="fname">
                                    </div>              
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Branch Phone *</label>
                                        <input type="text" class="form-control required" placeholder="02154211340" id="mobile" name="mobile" minLength=10>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Address *</label>
                                        <input type="text" class="form-control required" id="address" placeholder="Ruko Golden 8, E/19, Jl. Ki Hajar Dewantoro,, Pakulonan Bar., Klp. Dua, Gading Serpong, Jawa Barat 15810" name="address" >
                                    </div>
                                    
                                </div>
							</div>
							<div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Information</label>
                                        <input type="text" class="form-control required" placeholder="infodago@kodekiddo.com " id="info" name="info" >
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
<script src="<?php echo base_url(); ?>assets/js/addBranch.js" type="text/javascript"></script>