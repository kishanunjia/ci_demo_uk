<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-xs-6">
                <h3 style="margin-top: 0px;">
                    <i class="fa fa-factorys"></i> Factory Management
                    <small>Add, Edit, Delete</small>
                </h3>
            </div>
            <div class="col-xs-6 text-right">
                <div class="form-group text-right">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>factory/addNew"><i class="fa fa-plus"></i> Add New</a>
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
                            <th>Sr. No.</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Landmark</th>
                            <th>Contact 1</th>
                            <th>Contact 2</th>
                            <th>Contact 3</th>
                            <th>Email 1</th>
                            <th>Email 2</th>
                            <th>User</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($factoryRecords))
                        {
                            foreach($factoryRecords as $record)
                            {
                        ?>
                        <tr>
                            <td><?=$record->fc_id;?></td>
                            <td>
                                <a href="javascript:void(0);" id="factorycodeTd<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factorycodeTd');">
                                    <input type="text" id="factorycode<?=$record->fc_id;?>" value="<?php echo $record->fc_code ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_code', 'factorycode<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_code ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factorynameTd<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factorynameTd');">
                                    <input type="text" id="factoryname<?=$record->fc_id;?>" value="<?php echo $record->fc_name ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_name', 'factoryname<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_name ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factoryaddressTd<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factoryaddressTd');">
                                    <input type="text" id="factoryaddress<?=$record->fc_id;?>" value="<?php echo $record->fc_address ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_address', 'factoryaddress<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_address ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factorylandmarkTd<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factorylandmarkTd');">
                                    <input type="text" id="factorylandmark<?=$record->fc_id;?>" value="<?php echo $record->fc_landmark ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_landmark', 'factorylandmark<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_landmark ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factorycontact1Td<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factorycontact1Td');">
                                    <input type="text" id="factorycontact1<?=$record->fc_id;?>" value="<?php echo $record->fc_contact1 ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_contact1', 'factorycontact1<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_contact1 ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factorycontact2Td<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factorycontact2Td');">
                                    <input type="text" id="factorycontact2<?=$record->fc_id;?>" value="<?php echo $record->fc_contact2 ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_contact2', 'factorycontact2<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_contact2 ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factorycontact3Td<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factorycontact3Td');">
                                    <input type="text" id="factorycontact3<?=$record->fc_id;?>" value="<?php echo $record->fc_contact3 ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_contact3', 'factorycontact3<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_contact3; ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factoryemail1Td<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factoryemail1Td');">
                                    <input type="text" id="factoryemail1<?=$record->fc_id;?>" value="<?php echo $record->fc_email1 ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_email1', 'factoryemail1<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_email1; ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="factoryemail2Td<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'factoryemail2Td');">
                                    <input type="text" id="factoryemail2<?=$record->fc_id;?>" value="<?php echo $record->fc_email2 ?>" onfocusout="updateInline(<?=$record->fc_id;?>, 'fc_email2', 'factoryemail2<?=$record->fc_id;?>');" style="display: none;">
                                    <span><?php echo $record->fc_email2; ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="userroleTd<?=$record->fc_id;?>" onclick="editInline(<?=$record->fc_id;?>, 'userroleTd');">
                                    <select id="userrole<?=$record->fc_id;?>" onchange="updateInline(<?=$record->fc_id;?>, 'userId', 'userrole<?=$record->fc_id;?>');" style="display: none;">
                                        <option value="">Select user</option><?php 
                                        if($users){
                                            foreach ($users as $role) {
                                                $sel = ($record->userId == $role->userId)?'selected':''; ?>
                                                <option <?=$sel;?> value="<?=$role->userId;?>"><?=$role->name;?></option><?php 
                                            }
                                        } ?>
                                    </select>
                                    <span><?php echo $record->username; ?></span>
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="<?= base_url().'/factory/log/'.$record->fc_id; ?>" title="Log"><i class="fa fa-history"></i></a> |
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'factory/editOld/'.$record->fc_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-sm btn-danger deleteFactory" href="#" data-factoryid="<?php echo $record->fc_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
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
        jQuery.post(baseURL+"/factory/update",
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
