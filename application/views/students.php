<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Management
      </h1>
    </section>
    <section class="content">
	<?php
            if($role == ROLE_ADMIN || $role == ROLE_MANAGER)
            {
            ?>
        <div class="row">		
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewStudent">Add Student</a>
                </div>
            </div>
			
        </div>
	<?php
				}
			?>
			
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Students List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table">
				  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Name</th>
                      <th>Status</th>
					  <th>Branch</th>
					  <th>Schedule</th>
                      <th>Mobile</th>
                      <th>Parent Name</th>
					  <th>Parent E-mail</th>
                      <th>Actions</th>
					  <!--th>Address</th>
                      <th>Source</th>
					  <th>Age</th>
					  <th>Class</th>
					  <th>School</th-->
                    </tr>
					</thead>
					<tbody>
                    <?php
                    if(!empty($studentRecords))
                    {
						$no=0;
                        foreach($studentRecords as $record)
                        {
                    ?>
                    <tr>
					
                      <td><?php $no++;
					  echo $no//$record->studentId ?></td>
                      <td><a href="<?php echo base_url().'editOldStudent/'.$record->studentId; ?>"><?php echo $record->name ?></a></td>
                      <td><?php echo $record->status ?></td>
					  <td><?php if($record->name_branch!='') {echo $record->name_branch;} else {?> <font color="red">Needs Reassignment</font> <?php }  ?></td>
					  <td><?php if($record->day!='') {echo $record->day.' '.$record->schedule;} else {?> <font color="red">Needs Reassignment</font> <?php }  ?></td>
                      <td><?php echo $record->mobile ?></td>
                      <td><?php echo $record->parent_name ?></td>
					  <td><?php echo $record->parent_email ?></td>
					  <td>
                          <a href="<?php echo base_url().'editOldStudent/'.$record->studentId; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="#" data-studentid="<?php echo $record->studentId; ?>" class="deleteStudent"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
					  <!--td><?php// echo $record->address ?></td>
					  <td><?php //echo $record->source ?></td>
					  <td><?php //echo $record->age ?></td>
					  <td><?php //echo $record->kelas ?></td>
					  <td><?php //echo $record->school ?></td-->
                      
                    </tr>
                    <?php
                        }
                    }
                    ?>
					</tbody>
                  </table>
                  
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common_student.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "studentListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable();
});
</script>