<?php
$absentId = '';
$teacher1 = '';
$milestone = '';
$student_name = '';
$date = '';
$absent = '';
$class_schedule = '';
$point = '';
$group_project = '';
$unplugged = '';
$online = '';
$teacher_note = '';

if(!empty($absentInfo))
{
    foreach ($absentInfo as $uf)
    {
      $absentId = $uf->id;
      $student_name = $uf->Student_name;
      $date = $uf->date;
	  $absent = $uf->absent;
      $class_schedule = $uf->class;
      $point = $uf->point;
      $group_project = $uf->group_project;
      $unplugged = $uf->unplugged;
      $online = $uf->online;
	  $teacher1 = $uf->teacher;
	  $milestone = $uf->milestone;
      $teacher_note = $uf->teacher_note;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Absent Management
        <small>Add / Edit Absent</small>
      </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Absent Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>editAbsent" method="post" id="editAbsent" role="form">
                      <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="student_name">Student Name *</label>
                                        <input type="text" class="form-control required" id="student_name" name="student_name"value="<?php echo $student_name; ?>">
                                        <input type="hidden" value="<?php echo $absentId; ?>" name="absentId" id="absentId" />
                                    </div>
                                </div>
                            </div>
                            <p>Date: *<input type="text" id="datepicker" name="datepicker" value="<?php echo $date; ?>"></p>
                            <!--div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="class">Class</label>
                                      <select class="form-control required" id="class_schedule" name="class_schedule" value="<?php echo $class_schedule; ?>">
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
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
                <script type="text/javascript">
                $(function() {
                $( "#datepicker" ).datepicker();
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
                <label for="chkPassport">
                  <input type="checkbox" id="chkPassport" name="chkPassport" value="1" <?php if ($absent == 1){?> checked="checked" <?php } ?>/>
                  Check if Absent
                </label>
                <hr />
                <div id="dvPassport">
                  <!--div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="teacher">Teacher</label>
                            <select class="form-control" id="teacher" name="teacher"value="<?php echo $teacher; ?>">
                                <option value="0">Select Teacher</option>
                                <?php
                                if(!empty($teacher))
                                {
                                    foreach ($teacher as $rl)
                                    {
                                        ?>
										<option value="<?php echo $rl->userId; ?>" <?php if($rl->userId == $teacher1) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                          </div>
                      </div>
                  </div-->
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="point">Point</label>
                        <input type="text" class="form-control" id="point" placeholder="30" name="point" value="<?php echo $point; ?>">
                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="group_project">Group Project</label>
                      <input type="text" class="form-control" id="group_project" placeholder="Scrath Project make videos- Partial" name="group_project" value="<?php echo $group_project; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="unplugged">Unplugged</label>
                      <input type="text" class="form-control" id="unplugged" placeholder="Unplugged 1 make name with sphero - Finnish" placeholder="" name="unplugged" value="<?php echo $unplugged; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="online">Online</label>
                      <input type="text" class="form-control" id="online" placeholder="Unity project make game - Partial" name="online" value="<?php echo $online; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="teacher_note">Teacher Note</label>
                      <input type="text" class="form-control" id="teacher_note" placeholder="Student blabla" name="teacher_note" value="<?php echo $teacher_note; ?>">
                    </div>
                  </div>
                </div>
                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="teacher">MileStone</label>
                            <select class="form-control" id="milestone" name="milestone">
							<option value="<?php echo $milestone; ?>"><?php echo $milestone ?></option>
                                <option value="0">-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                          </div>
                      </div>
                  </div>
              </script>

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
        $query = mysqli_query($con, "SELECT name FROM tbl_students where isDeleted=0 and ScheduleId!=0")or die("Error: ".mysqli_error($con));
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
