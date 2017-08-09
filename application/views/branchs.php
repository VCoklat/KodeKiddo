<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Branch Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewBranch">New Branch</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
              <div class="box">
                
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table">
				  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Info</th>
                      <th>Actions</th>
                    </tr>
					</thead>
                    <?php
					$no=0;
                    if(!empty($branchRecords))
                    {
                        foreach($branchRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php 
					  $no++;
					  echo $no ?></td>
                      <td><?php echo $record->name_branch ?></td>
                      <td><?php echo $record->address ?></td>
                      <td><?php echo $record->phone ?></td>
                      <td><?php echo $record->info ?></td>
                      <td>
                          <a href="<?php echo base_url().'editOldBranch/'.$record->branchId; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="#" data-branchid="<?php echo $record->branchId; ?>" class="deleteBranch"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <!--div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div-->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common_branch.js" charset="utf-8"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable();
});
</script>