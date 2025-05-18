<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-xs-6">
                <h3 style="margin-top: 0px;">
                    <i class="fa fa-factorys"></i> Destination Management
                    <small>Add, Edit, Delete</small>
                </h3>
            </div>
            <div class="col-xs-6 text-right">
                <div class="form-group text-right">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>destination/addNew"><i class="fa fa-plus"></i> Add New</a>
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
                            <th width="5%">SrNo</th>
                            <th width="15%">Destination</th>
                            <th width="25%">Desc1</th>
                            <th width="25%">Desc2</th>
                            <th width="15%">User</th>
                            <th width="15%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($records))
                        {
                            foreach($records as $record)
                            {
                        ?>
                        <tr>
                            <td width="5%">
                                <a href="javascript:void(0);" id="destcodeTd<?=$record->dest_id;?>">
                                    <span><?php echo $record->dest_id; ?></span>
                                </a>
                            </td>
                            <td width="15%">
                                <a href="javascript:void(0);" id="destnameTd<?=$record->dest_id;?>" onclick="editInline(<?=$record->dest_id;?>, 'destnameTd');">
                                    <input type="text" id="destname<?=$record->dest_id;?>" value="<?php echo $record->dest_name ?>" onfocusout="updateInline(<?=$record->dest_id;?>, 'dest_name', 'destname<?=$record->dest_id;?>');" style="display: none;">
                                    <span><?php echo $record->dest_name; ?></span>
                                </a>
                            </td>
                            <td width="25%">
                                <a href="javascript:void(0);" id="factorydest_dest1Td<?=$record->dest_id;?>" onclick="editInline(<?=$record->dest_id;?>, 'factorydest_dest1Td');">
                                    <input type="text" id="factorydest_dest1<?=$record->dest_id;?>" value="<?php echo $record->dest_dest1 ?>" onfocusout="updateInline(<?=$record->dest_id;?>, 'dest_dest1', 'factorydest_dest1<?=$record->dest_id;?>');" style="display: none;">
                                    <span><?php echo $record->dest_dest1; ?></span>
                                </a>
                            </td>
                            <td width="25%"> 
                                <a href="javascript:void(0);" id="factorydest_dest2Td<?=$record->dest_id;?>" onclick="editInline(<?=$record->dest_id;?>, 'factorydest_dest2Td');">
                                    <input type="text" id="factorydest_dest2<?=$record->dest_id;?>" value="<?php echo $record->dest_dest2; ?>" onfocusout="updateInline(<?=$record->dest_id;?>, 'dest_dest2', 'factorydest_dest2<?=$record->dest_id;?>');" style="display: none;">
                                    <span><?php echo $record->dest_dest2; ?></span>
                                </a>
                            </td>

                            <td width="15%">
                                <a href="javascript:void(0);" id="userroleTd<?=$record->dest_id;?>" onclick="editInline(<?=$record->dest_id;?>, 'userroleTd');">
                                    <select id="destusersel<?=$record->dest_id;?>" onchange="updateInline(<?=$record->dest_id;?>, 'userId', 'destusersel<?=$record->dest_id;?>');" style="display: none;">
                                        <option value="0">Select User</option><?php 
                                        if($userlist){
                                            foreach ($userlist as $ulist) {
                                                $sel = ($record->userId == $ulist->userId)?'selected':''; ?>
                                                <option <?=$sel;?> value="<?=$ulist->userId;?>"><?=$ulist->name;?></option><?php 
                                            }
                                        } ?>
                                    </select>
                                    <span><?php echo $record->name; ?></span>
                                </a>
                            </td>

                            <td width="15%" class="text-center">
                                <a class="btn btn-sm btn-primary" href="<?= base_url().'/destination/log/'.$record->dest_id; ?>" title="Log"><i class="fa fa-history"></i></a> |
                                <?php if($edit_per){ ?>
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'destination/editOld/'.$record->dest_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a><?php } ?>
                                <?php if($delete_per){ ?>
                                <a class="btn btn-sm btn-danger deleteDestination" href="#" data-dest_id="<?php echo $record->dest_id; ?>" title="Delete"><i class="fa fa-trash"></i></a><?php } ?>
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
        jQuery.post(baseURL+"destination/update",
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
