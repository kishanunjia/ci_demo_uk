<?php

$dest_id  = (isset($dataInfo->dest_id))?$dataInfo->dest_id:'';
$userId = (isset($dataInfo->userId))?$dataInfo->userId:'';
$dest_name = (isset($dataInfo->dest_name))?$dataInfo->dest_name:'';
$dest_dest1 = (isset($dataInfo->dest_dest1))?$dataInfo->dest_dest1:'';
$dest_dest2 = (isset($dataInfo->dest_dest2))?$dataInfo->dest_dest2:'';


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Destination Management
        <small><?=($dest_id == '')?'Add':'Edit';?> Destination</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Destination Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url('/destination/'); ?><?=($dest_id == '')?'addNewDestination':'editDestination';?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Destination Name</label>
                                        <input type="text" class="form-control required" value="<?=$dest_name;?>" id="dest_name" name="dest_name" maxlength="255">
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Description 1</label>
                                        <textarea class="form-control" id="dest_dest1" name="dest_dest1"><?=$dest_dest1; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Description 2</label>
                                        <textarea class="form-control" id="dest_dest2" name="dest_dest2"><?=$dest_dest2; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="isAdmin">Select User</label>
                                        <select class="form-control required" id="userId" name="userId">
                                        <option value="0">Select User</option><?php 
                                        if($userlist){
                                            foreach ($userlist as $ulist) {
                                                $sel = ($userId == $ulist->userId)?'selected':''; ?>
                                                <option <?=$sel;?> value="<?=$ulist->userId;?>"><?=$ulist->name;?></option><?php 
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
                                    
                                    <input type="hidden" name="dest_id" value="<?=$dest_id;?>">
                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                    <input type="reset" class="btn btn-default" value="Reset" />

                                </div>
                                <div class="col-md-4 text-right">
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('/destination'); ?>">Back</a>
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
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>