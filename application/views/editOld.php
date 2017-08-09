<?php

$userId = '';
$name = '';
$email = '';
$mobile = '';
$roleId = '';
$address = '';
$branchId = '';

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->userId;
        $name = $uf->name;
        $email = $uf->email;
        $mobile = $uf->mobile;
        $roleId = $uf->roleId;
		$branchId = $uf->branchId;
		$address = $uf->address;
		$status = $uf->status;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Management
        <small>Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editUser" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name *</label>
                                        <input type="text" class="form-control" id="fname" placeholder="John Doe" name="fname" value="<?php echo $name; ?>" >
                                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address *</label>
                                        <input type="email" class="form-control" id="email" placeholder="example@example.com" name="email" value="<?php echo $email; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password </label>
                                        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" id="password" placeholder="Password" name="password" minlength="4">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password </label>
                                        <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" minlength="4">
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Address *</label>
                                        <input type="text" class="form-control required" placeholder="Jl example" id="address" name="address" value="<?php echo $address; ?>">
                                    </div>  
                                </div>
							</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number *</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="08xxxxxxxxxx" name="mobile" value="<?php echo $mobile; ?>" minlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role *</label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="0">Select Role</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->roleId; ?>" <?php if($rl->roleId == $roleId) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
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
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Status *</label>
                                        <select class="form-control" id="status" name="status">
                                            <!--option value="0">Select Branch</option-->
                                            
                                            <option value="1" <?php if($status== 1) {echo "selected=selected";} ?>>
											Active</option>
                                            <option value="2" <?php if($status== 2) {echo "selected=selected";} ?>>
											Non-Active</option>
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>