<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-xs-6">
                <h3 style="margin-top: 0px;">
                    <i class="fa fa-users"></i> User Management
                    <small>Add, Edit, Delete</small>
                </h3>
            </div>
            <div class="col-xs-6 text-right">
                <div class="form-group text-right">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
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
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header"></div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="table_id" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($userRecords))
                        {
                            foreach($userRecords as $record)
                            {
                        ?>
                        <tr>
                            <td>
                                <a href="javascript:void(0);" id="usernameTd<?=$record->userId;?>" onclick="editInline(<?=$record->userId;?>, 'usernameTd');">
                                    <input type="text" id="username<?=$record->userId;?>" value="<?php echo $record->name ?>" onfocusout="updateInline(<?=$record->userId;?>, 'name', 'username<?=$record->userId;?>');" style="display: none;">
                                    <span><?php echo $record->name ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="useremailTd<?=$record->userId;?>" onclick="editInline(<?=$record->userId;?>, 'useremailTd');">
                                    <input type="text" id="useremail<?=$record->userId;?>" value="<?php echo $record->email ?>" onfocusout="updateInline(<?=$record->userId;?>, 'email', 'useremail<?=$record->userId;?>');" style="display: none;">
                                    <span><?php echo $record->email ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="usermobileTd<?=$record->userId;?>" onclick="editInline(<?=$record->userId;?>, 'usermobileTd');">
                                    <input type="text" id="usermobile<?=$record->userId;?>" value="<?php echo $record->mobile ?>" onfocusout="updateInline(<?=$record->userId;?>, 'mobile', 'usermobile<?=$record->userId;?>');" style="display: none;">
                                    <span><?php echo $record->mobile ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="userroleTd<?=$record->userId;?>" onclick="editInline(<?=$record->userId;?>, 'userroleTd');">
                                    <select id="userrole<?=$record->userId;?>" onchange="updateInline(<?=$record->userId;?>, 'roleId', 'userrole<?=$record->userId;?>');" style="display: none;">
                                        <option value="">Select role</option><?php 
                                        if($roles){
                                            foreach ($roles as $role) {
                                                $sel = ($record->roleId == $role->roleId)?'selected':''; ?>
                                                <option <?=$sel;?> value="<?=$role->roleId;?>"><?=$role->role;?></option><?php 
                                            }
                                        } ?>
                                    </select>
                                    <span><?php echo $record->role ?></span>
                                </a>

                                <?php /*echo $record->role; if($record->roleStatus == INACTIVE) { echo ' <span class="label label-warning">Inactive</span>'; }*/ ?>
                                
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a> | 
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOld/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });

    jQuery('input').on("focusout", function() {
        jQuery(this).hide();

        jQuery(this).parent().find('span').show();
        jQuery(this).parent().find('span').text(jQuery(this).val());

    });

    jQuery('select').on("change", function() {
        var id = jQuery(this).attr('id');
        var text = jQuery('#'+id+" option:selected" ).text();
        setTimeout(function(){  
            jQuery('#'+id).hide();
            jQuery('#'+id).removeClass('ss');
            jQuery('#'+id).parent('a').find('span').show();
            jQuery('#'+id).parent('a').find('span').text(text);
        }, 500);
    });

    function editInline(id, idname){
        jQuery('#'+idname+id).find('input').toggle();

        var searchInput = jQuery('#'+idname+id).find('input'); console.log(searchInput);
        if(typeof searchInput.val() === "undefined"){
            if(!jQuery('#'+idname+id).find('select').hasClass("ss")){
                jQuery('#'+idname+id).find('span').hide();
                jQuery('#'+idname+id).find('select').show();
                jQuery('#'+idname+id).find('select').addClass('ss');
            }            
        }else{
            jQuery('#'+idname+id).find('span').toggle();

            var strLength = searchInput.val().length * 2;
            searchInput.focus();
            searchInput[0].setSelectionRange(strLength, strLength);
        }
    }

    function updateInline(id, field, fieldid) {
        var val = jQuery('#'+fieldid).val();
        jQuery.post(baseURL+"user/update",
          {
            field: field,
            id: id,
            val: val
          },
          function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
          });
    }
</script>
