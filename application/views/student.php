<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Role</th>
                      <th>Branch</th>
                      <th>Actions</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $record->studentId ?></td>
                      <td><?php echo $record->student ?></td>
                      <td><?php echo $record->address ?></td>
                      <td><?php echo $record->isDeleted ?></td>
                      <td><?php echo $record->age ?></td>
                      <td><?php echo $record->class ?></td>
                      <td>
                          <a href="#" data-userid="<?php echo $record->userId; ?>" class="deleteUser"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>

                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
