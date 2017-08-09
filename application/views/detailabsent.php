<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Absent Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>absentListing">Absent List</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Detail Absents</h3>
                    <!--div class="box-tools">
                        <form action="<?php echo base_url() ?>absentListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div-->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped table-hover" id="book-table">
                    <thead>
					<tr>
                      <th>Id</th>
                      <th>Student Name</th>
                      <th>Class Day</th>
					  <th>Class Time</th>
                      <th>Absent</th>
                      <th>Date</th>
					  <th>Point</th>
					  <th>Unplugged</th>
					  <th>Online</th>
					  <th>Group Project</th>
					  <th>Teacher Note</th>
					  <th>Milestone</th>
                    </tr>
					</thead>
					<tbody>
                    <?php
                    if(!empty($absentRecords))
                    {
                      $no=1;
                        foreach($absentRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $record->Student_name ?></td>
                      <td><?php echo $record->day ?></td>
					  <td><?php echo $record->schedule ?></td>
                      <td><?php if ($record->absent==0) echo "NO"; else echo "YES"; ?></td>
                      <td><?php echo $record->date; 
					  $nama = $record->Student_name;
						$con = mysqli_connect('localhost', 'root', '');
						mysqli_select_db($con,"cias");
						$no = 1;
							
						$query = mysqli_query($con, "SELECT studentId FROM tbl_students WHERE name= '$nama' ;")or die("Error: ".mysqli_error($con));
						while($hasil=mysqli_fetch_array($query)){
							$id1 = $hasil['studentId'];
						}	?></td>
					  <td><?php echo $record->point ?></td>
					  <td><?php echo $record->unplugged ?></td>
					  <td><?php echo $record->online ?></td>
					  <td><?php echo $record->group_project ?></td>
					  <td><?php echo $record->teacher_note ?></td>
					  <td><?php echo $record->milestone ?></td>
                    </tr>
                    <?php
                    $no++;
                        }
                    }
                    ?>
					</tbody>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common_absent.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "absentListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable();
});
</script>