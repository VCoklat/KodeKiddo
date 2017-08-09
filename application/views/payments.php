<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Management
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
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewPayment">Add Payment</a>
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
                    <h3 class="box-title">Payments List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table">
				  <thead>
                    <tr>
                      <th style="width: 200px">No</th>
                      <th>Student Name</th>
                      <th>Nominal</th>
					  <th>Note</th>
					  <th>Method</th>
					  <!--th>Address</th>
                      <th>Source</th>
					  <th>Age</th>
					  <th>Class</th>
					  <th>School</th-->
                    </tr>
					</thead>
					<tbody>
                    <?php
                    if(!empty($paymentRecords))
                    {
						$no=0;
                        foreach($paymentRecords as $record)
                        {
                    ?>
                    <tr>
					
                      <td><?php $no++;
					  echo $no//$record->paymentId ?></td>
                      <td><?php echo $record->studentId ?></td>
                      <td><?php echo $record->nominal ?></td>
					  
                      <td><?php echo $record->note?></td>
                      <td><?php echo $record->method ?></td>
					  
                      
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common_payment.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "paymentListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable();
});
</script>