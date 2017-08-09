<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedule Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewSchedule">Add Schedule</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
              <div class="box-header">
                    <h3 class="box-title">Schedule List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table">
				  <thead>
                    <tr>
                      <th>No</th>
                      <th>Day</th>
					  <th>Time</th>
					  <th>Branch</th>
                      <th>Actions</th>
                    </tr>
					</thead>
                    <?php
					$no=0;
                    if(!empty($scheduleRecords))
                    {
                        foreach($scheduleRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php 
					  $no++;
					  echo $no ?></td>
                      <td><?php echo $record->day ?></td>
					  <td><?php echo $record->schedule ?></td>
					  <td><?php echo $record->name_branch ?></td>
                      <td>
                          <a href="<?php echo base_url().'editOldSchedule/'.$record->scheduleId; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="#" data-scheduleid="<?php echo $record->scheduleId; ?>" class="deleteSchedule"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common_schedule.js" charset="utf-8"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable();
});
</script>