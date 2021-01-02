<?php include_once('../controller/CommonController.php');?>
<?php include_once('header.php');?>
<?php if(isset($_GET['action']) &&  ( $_GET['action'] == 'edit' )){
		$id=$_GET['id'];
		$getuserdetail = $userObj->getUsersById($id);
		$getsingledata=$getuserdetail[0];
}
	?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            
			

            <!-- page content -->
            <div class="col-md-12" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Form Validation</h3>
                        </div>

                      
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>List <small><a href="<?php echo $CONFIG_SERVER_ROOT;?>mylist/" class="text-danger">All</a></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
								 <?php 
 //displaying messages
 echo $commonObj->displaySessionMessage();?>
 <!-- Submit goes to commoncontroller-->
                                    <form class="" action="<?php print $CONFIG_SERVER_ROOT;?>CommonController/" method="post" novalidate>
                                       
                                        <span class="section">Personal Info</span>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control"  name="name" placeholder="Enter Name" required="required" value="<?php if(isset($getsingledata) && $getsingledata!=""){print $getsingledata['user_name'];}?>" />
                                            </div>
                                        </div>
                                       
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" name="email" class='email' required="required" type="email" value="<?php if(isset($getsingledata) && $getsingledata!=""){print $getsingledata['email_address'];}?>"  /></div>
                                        </div>
                                       
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="number" class='number' data-validate-length-range="10,10" name="number"  required='required' value="<?php if(isset($getsingledata) && $getsingledata!=""){print $getsingledata['mobile_no'];}?>" ></div>
                                        </div>
                                       
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
												

<?php //for update 
if(isset($getsingledata) && $getsingledata!=""){?>
<input type="hidden" name="userid" value="<?php print $getsingledata['user_id'];?>">
<input type="hidden" name="formeditdata" value="formeditdata">
<?php }else{?>
<input type="hidden" name="formsavedata" value="formsavedata">
<?php }?>

                                                    <button type='submit' class="btn btn-primary">Submit</button>
                                                    <button type='reset' class="btn btn-success">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo $CONFIG_SERVER_ROOT;?>vendors/validator/multifield.js"></script>
    <script src="<?php echo $CONFIG_SERVER_ROOT;?>vendors/validator/validator.js"></script>
    
   

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
           
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);

    </script>

    <!-- jQuery -->
    <script src="<?php echo $CONFIG_SERVER_ROOT;?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $CONFIG_SERVER_ROOT;?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
