<?php
$factoryId = ($factoryInfo)?$factoryInfo->fc_id:0;
$fc_code = ($factoryInfo)?$factoryInfo->fc_code:'';
$fc_name = ($factoryInfo)?$factoryInfo->fc_name:'';
$fc_address = ($factoryInfo)?$factoryInfo->fc_address:'';
$fc_landmark = ($factoryInfo)?$factoryInfo->fc_landmark:'';
$fc_contact1 = ($factoryInfo)?$factoryInfo->fc_contact1:'';
$fc_contact2 = ($factoryInfo)?$factoryInfo->fc_contact2:'';
$fc_contact3 = ($factoryInfo)?$factoryInfo->fc_contact3:'';
$fc_email1 = ($factoryInfo)?$factoryInfo->fc_email1:'';
$fc_email2 = ($factoryInfo)?$factoryInfo->fc_email2:'';
$userId = ($factoryInfo)?$factoryInfo->userId:'';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-factorys"></i> Factory Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Factory Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>factory/addEditFactory" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_code">Code</label>
                                        <input type="text" required class="form-control" id="fc_code" placeholder="" name="fc_code" value="<?php echo $fc_code; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="fc_name">Name</label>
                                        <input type="text" required class="form-control" id="fc_name" placeholder="" name="fc_name" value="<?php echo $fc_name; ?>">
                                        <input type="hidden" value="<?php echo $factoryId; ?>" name="factoryId" id="factoryId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_address">Address</label>
                                        <textarea class="form-control" required id="fc_address" name="fc_address"><?=$fc_address;?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_landmark">Landmark</label>
                                        <input type="text" class="form-control" required id="fc_landmark" placeholder="" name="fc_landmark" value="<?=$fc_landmark;?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_contact1">Contact 1</label>
                                        <input type="text" class="form-control" id="fc_contact1" name="fc_contact1" value="<?php echo $fc_contact1; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_contact1">Contact 2</label>
                                        <input type="text" class="form-control" id="fc_contact2" name="fc_contact2" value="<?php echo $fc_contact2; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_contact1">Contact 3</label>
                                        <input type="text" class="form-control" id="fc_contact3" name="fc_contact3" value="<?php echo $fc_contact3; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_email1">Email 1</label>
                                        <input type="email" class="form-control" id="fc_email1" name="fc_email1" value="<?php echo $fc_email1; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_email2">Email 2</label>
                                        <input type="email" class="form-control" id="fc_email2" name="fc_email2" value="<?php echo $fc_email2; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fc_email2">User</label>
                                        <select id="userrole" class="form-control" name="userId">
                                            <option value="">Select user</option><?php 
                                            if($users){
                                                foreach ($users as $role) {
                                                    $sel = ($userId == $role->userId)?'selected':''; ?>
                                                    <option <?=$sel;?> value="<?=$role->userId;?>"><?=$role->name;?></option><?php 
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div> 
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                    <input type="reset" class="btn btn-default" value="Reset" />
                                </div>
                                <div class="col-md-4 text-right">
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('/factory'); ?>">Back</a>
                                </div>    
                            </div>
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>