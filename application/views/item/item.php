<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-xs-6">
                <h3 style="margin-top: 0px;">
                    <i class="fa fa-factorys"></i> Items Management
                    <small>Add, Edit, Delete</small>
                </h3>
            </div>
            <div class="col-xs-6 text-right">
                <div class="form-group text-right">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>items/addNew"><i class="fa fa-plus"></i> Add New</a>
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
                            <th>SrNo</th>
                            <th>Code</th>
                            <th>Desc1</th>
                            <th>Desc2</th>
                            <th>Desc3</th>
                            <th>Factory</th>
                            <th>OPStk1</th>
                            <th>OPStk2</th>
                            <th>OPStk3</th>
                            <th>OPStk4</th>
                            <th>CLStk1</th>
                            <th>CLStk2</th>
                            <th>CLStk3</th>
                            <th>CLStk4</th>
                            <th class="text-center">Actions</th>
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
                            <td>
                                <a href="javascript:void(0);" id="destcodeTd<?=$record->item_id;?>">
                                    <span><?php echo $record->item_id; ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="item_codeTd<?=$record->item_id;?>" onclick="editInline(<?=$record->item_id;?>, 'item_codeTd');">
                                    <input type="text" id="item_code<?=$record->item_id;?>" value="<?php echo $record->item_code ?>" onfocusout="updateInline(<?=$record->item_id;?>, 'item_code', 'item_code<?=$record->item_id;?>');" style="display: none;">
                                    <span><?php echo $record->item_code; ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="item_desc1Td<?=$record->item_id;?>" onclick="editInline(<?=$record->item_id;?>, 'item_desc1Td');">
                                    <input type="text" id="item_desc1<?=$record->item_id;?>" value="<?php echo $record->item_desc1 ?>" onfocusout="updateInline(<?=$record->item_id;?>, 'item_desc1', 'item_desc1<?=$record->item_id;?>');" style="display: none;">
                                    <span><?php echo $record->item_desc1; ?></span>
                                </a>
                            </td>
                            <td> 
                                <a href="javascript:void(0);" id="item_desc2Td<?=$record->item_id;?>" onclick="editInline(<?=$record->item_id;?>, 'item_desc2Td');">
                                    <input type="text" id="item_desc2<?=$record->item_id;?>" value="<?php echo $record->item_desc2; ?>" onfocusout="updateInline(<?=$record->item_id;?>, 'item_desc2', 'item_desc2<?=$record->item_id;?>');" style="display: none;">
                                    <span><?php echo $record->item_desc2; ?></span>
                                </a>
                            </td>
                            <td> 
                                <a href="javascript:void(0);" id="item_desc3Td<?=$record->item_id;?>" onclick="editInline(<?=$record->item_id;?>, 'item_desc3Td');">
                                    <input type="text" id="item_desc3<?=$record->item_id;?>" value="<?php echo $record->item_desc3; ?>" onfocusout="updateInline(<?=$record->item_id;?>, 'item_desc3', 'item_desc3<?=$record->item_id;?>');" style="display: none;">
                                    <span><?php echo $record->item_desc3; ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="fc_idTd<?=$record->item_id;?>" onclick="editInline(<?=$record->item_id;?>, 'fc_idTd');">
                                    <select id="fc_idsel<?=$record->item_id;?>" onchange="updateInline(<?=$record->item_id;?>, 'fc_id', 'fc_idsel<?=$record->item_id;?>');" style="display: none;">
                                        <option value="0">Select Factory</option><?php 
                                        if($factorylist){
                                            foreach ($factorylist as $flist) {
                                                $sel = ($record->fc_id == $flist->fc_id)?'selected':''; ?>
                                                <option <?=$sel;?> value="<?=$flist->fc_id;?>"><?=$flist->fc_name;?></option><?php 
                                            }
                                        } ?>
                                    </select>
                                    <span><?=(!empty($record->fc_name))?$record->fc_name:'Select Factory'; ?></span>
                                </a>
                            </td>

                            
                            <td><?=$record->OPStk1;?></td>
                            <td><?=$record->OPStk2;?></td>
                            <td><?=$record->OPStk3;?></td>
                            <td><?=$record->OPStk4;?></td>
                            <td><?=$record->CLStk1;?></td>
                            <td><?=$record->CLStk2;?></td>
                            <td><?=$record->CLStk3;?></td>
                            <td><?=$record->CLStk4;?></td>

                            

                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="<?= base_url().'/items/log/'.$record->item_id; ?>" title="Log"><i class="fa fa-history"></i></a> |
                                <?php if($edit_per){ ?>
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'items/editOld/'.$record->item_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a><?php } ?>
                                <?php if($delete_per){ ?>
                                <a class="btn btn-sm btn-danger deleteItemb" href="#" data-item_id="<?php echo $record->item_id; ?>" title="Delete"><i class="fa fa-trash"></i></a><?php } ?>
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
        jQuery.post(baseURL+"items/update",
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
