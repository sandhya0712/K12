<?php include_once('../controller/CommonController.php');?>
<?php include_once('header.php');?>

   <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small>List Of All Users</small></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
			
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><a href="<?php echo $CONFIG_SERVER_ROOT;?>" class="text-danger">Home</a><small>List Users</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
						  <?php 
 //displaying messages
 echo $commonObj->displaySessionMessage();?>
                            <div class="card-box table-responsive">
							<table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Number</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
					  <?php
					if(!empty($getallusers)){
							foreach($getallusers as $eachUser){?>
                        <tr>
                          <td><?php print $eachUser['user_name'];?></td>
                          <td><?php print $eachUser['email_address'];?></td>
                          <td><?php print $eachUser['mobile_no'];?></td>
                         <td><a href="<?php echo $CONFIG_SERVER_ROOT;?>index/edit/<?php print $eachUser['user_id'];?>" class="btn btn-success">Edit</a> <a href="<?php echo $CONFIG_SERVER_ROOT;?>CommonController/?action=delete&id=<?php print $eachUser['user_id'];?>"  title="Delete User" class="btn btn-danger">Delete</a></td>
                        </tr>
					<?php }}else{?>No Data Found<?php }?>
                          </tbody>
                    </table>
                   
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
		</div>
		</div>
