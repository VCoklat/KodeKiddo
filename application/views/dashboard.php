<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php
                  $con=mysqli_connect("localhost","root","","cias");
                  $sql_branch="SELECT branch FROM tbl_users where name='$name'";
                  if ($result_branch=mysqli_query($con,$sql_branch))
                    {
                    // Return the number of rows in result set
                    $tes=mysqli_fetch_assoc($result_branch);
                    $branch= $tes['branch'];
                    // Free result set
                    mysqli_free_result($result_branch);
                    }

                    //if ($branch==1)
                    //{
                       $sql="SELECT userId FROM tbl_users where isDeleted=0 and roleId=3";
                    /*} else {
                       $sql="SELECT userId FROM tbl_users where isDeleted=0 and roleId=3 and branch='$branch'";
                    }*/
                     if ($result=mysqli_query($con,$sql))
                       {
                       // Return the number of rows in result set
                       $rowcount=mysqli_num_rows($result);
                       // Free result set
                       mysqli_free_result($result);
                       }

                     mysqli_close($con);
                     echo $rowcount;
                  ?></h3>
                  <p>Teacher</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <?php				
				if($role == ROLE_ADMIN)
				{
				?>
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php
                  $con=mysqli_connect("localhost","root","","cias");
                     $sql="SELECT name_branch FROM tbl_branchs where isDeleted=0 and branchId!=1";
                     if ($result=mysqli_query($con,$sql))
                       {
                       // Return the number of rows in result set
                       $rowcount=mysqli_num_rows($result);
                       // Free result set
                       mysqli_free_result($result);
                       }

                     mysqli_close($con);
                     echo $rowcount;
                  ?>
				 </h3>
                  <p>Branch</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url(); ?>branchListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
              <?php } ?>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php
                  $con=mysqli_connect("localhost","root","","cias");
                  //if ($branch==1)
                  //{
                     $sql="SELECT name FROM tbl_students where isDeleted=0";
                  //} else {
                   //  $sql="SELECT student FROM tbl_students where isDeleted=0 and branch='$branch'";
                  //}

                     if ($result=mysqli_query($con,$sql))
                       {
                       // Return the number of rows in result set
                       $rowcount=mysqli_num_rows($result);
                       // Free result set
                       mysqli_free_result($result);
                       }

                     mysqli_close($con);
                     echo $rowcount;
                  ?></h3>
                  <p>Student</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url(); ?>studentListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php
					$con=mysqli_connect("localhost","root","","cias");
					$rowcount=0;
                     $sql="SELECT total_attedance, total_paid FROM tbl_students where isDeleted=0";
                     $hasil=mysqli_query($con,$sql);
					 while($result=mysqli_fetch_array($hasil))
					 {
						 $attedance= $result['total_attedance'];
						 $paid= $result['total_paid'];
						 if(($attedance!=0) && ($paid!=0)){
						 if ($attedance>=$paid)
						 {
							 $rowcount++;
						 }}
					 }
                     mysqli_close($con);
                     echo $rowcount;
                  ?></h3>
                  <p>Outstanding Payment</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url(); ?>outstandingListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
               <?php				
				if($role == ROLE_ADMIN)
				{
				?>
              <div class="small-box bg-black">
                <div class="inner">
                  <h3><?php
                  $con=mysqli_connect("localhost","root","","cias");
                     $sql="SELECT userId FROM tbl_users where isDeleted=0 and roleId=2";
                     if ($result=mysqli_query($con,$sql))
                       {
                       // Return the number of rows in result set
                       $rowcount=mysqli_num_rows($result);
                       // Free result set
                       mysqli_free_result($result);
                       }

                     mysqli_close($con);
                     echo $rowcount;
                  ?></h3>
                  <p>Admin</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
              <?php }?>
            </div><!-- ./col -->
          </div>
    </section>
</div>
