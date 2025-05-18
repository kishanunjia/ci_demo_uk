<?php

$item_id  = (isset($dataInfo->item_id))?$dataInfo->item_id:'';
$item_code = (isset($dataInfo->item_code))?$dataInfo->item_code:'';
//$userId = (isset($dataInfo->userId))?$dataInfo->userId:'';
$item_desc1 = (isset($dataInfo->item_desc1))?$dataInfo->item_desc1:'';
$item_desc2 = (isset($dataInfo->item_desc2))?$dataInfo->item_desc2:'';
$item_desc3 = (isset($dataInfo->item_desc3))?$dataInfo->item_desc3:'';

$fc_id = (isset($dataInfo->fc_id))?$dataInfo->fc_id:'';

$OPStk1 = (isset($dataInfo->OPStk1))?$dataInfo->OPStk1:'';
$OPStk2 = (isset($dataInfo->OPStk2))?$dataInfo->OPStk2:'';
$OPStk3 = (isset($dataInfo->OPStk3))?$dataInfo->OPStk3:'';
$OPStk4 = (isset($dataInfo->OPStk4))?$dataInfo->OPStk4:'';

$CLStk1 = (isset($dataInfo->CLStk1))?$dataInfo->CLStk1:'';
$CLStk2 = (isset($dataInfo->CLStk2))?$dataInfo->CLStk2:'';
$CLStk3 = (isset($dataInfo->CLStk3))?$dataInfo->CLStk3:'';

//$fa_id = (isset($dataInfo->fa_id))?$dataInfo->fa_id:'';


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Item Management
        <small><?=($item_id == '')?'Add':'Edit';?> Item</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Item Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" enctype="multipart/form-data" action="<?php echo base_url('/items/'); ?><?=($item_id == '')?'addNewItem':'editItem';?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="fname">Item Image (.jpg,png,jpeg)</label>
                                        <input type="file" class="form-control" id="item_image" name="item_image">
                                    </div>        
                                </div>

                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="fname">Item Code<span class="req">*</span></label>
                                        <input type="text" class="form-control required" value="<?=$item_code;?>" id="item_code" name="item_code" maxlength="255">
                                    </div>        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="fname">Factory<span class="req">*</span></label>
                                        <select class="form-control required" id="fc_id" name="fc_id">
                                        <option value="0">Select Factory</option><?php 
                                        if($factorylist){
                                            foreach ($factorylist as $flist) {
                                                $sel = ($fc_id == $flist->fc_id)?'selected':''; ?>
                                                <option <?=$sel;?> value="<?=$flist->fc_id;?>"><?=$flist->fc_name;?></option><?php 
                                            }
                                        } ?>
                                        </select>                                        

                                    </div>        
                                </div>                                
                            </div>    
                            <div class="row">    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Description 1<span class="req">*</span></label>
                                        <textarea class="form-control required" id="item_desc1" name="item_desc1"><?=$item_desc1; ?></textarea>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Description 2<span class="req">*</span></label>
                                        <textarea class="form-control required" id="item_desc2" name="item_desc2"><?=$item_desc2; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Description 3<span class="req">*</span></label>
                                        <textarea class="form-control required" id="item_desc3" name="item_desc3"><?=$item_desc3; ?></textarea>
                                    </div>
                                </div>
                            </div> 
                            <div class="row"> 
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">OPStk1<span class="req">*</span></label>
                                        <input type="text" class="form-control required" value="<?=$OPStk1;?>" id="OPStk1" name="OPStk1" maxlength="50">
                                    </div>        
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">OPStk2<span class="req">*</span></label>
                                        <input type="text" class="form-control required" value="<?=$OPStk2;?>" id="OPStk2" name="OPStk2" maxlength="50">
                                    </div>        
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">OPStk3<span class="req">*</span></label>
                                        <input type="text" class="form-control required" value="<?=$OPStk3;?>" id="OPStk3" name="OPStk3" maxlength="50">
                                    </div>        
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">OPStk4<span class="req">*</span></label>
                                        <input type="text" class="form-control required" value="<?=$OPStk4;?>" id="OPStk4" name="OPStk4" maxlength="50">
                                    </div>        
                                </div>
                            </div>    
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-8">
                                    
                                    <input type="hidden" name="item_id" value="<?=$item_id;?>">
                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                    <input type="reset" class="btn btn-default" value="Reset" />

                                </div>
                                <div class="col-md-4 text-right">
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('/items'); ?>">Back</a>
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