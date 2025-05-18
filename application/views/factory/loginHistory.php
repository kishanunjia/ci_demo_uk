<?php
$log = ($factoryInfo)?$factoryInfo->fc_log:'';
$log = ($log)?json_decode($log):array();
$log = array_reverse($log);
?><link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" />
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Log History
      <small>track Log history</small>
    </h1>
  </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?= !empty($factoryInfo) ? $factoryInfo->fc_code." : ".$factoryInfo->fc_name : "Factory" ?></h3>
                    <div class="box-tools">
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>User Name</th>
                      <th>Date-Time</th>
                    </tr>
                    <?php
                    if(!empty($log))
                    {
                      foreach($log as $record){
                        $this->db->select('*');
                        $this->db->from('tbl_users');
                        $this->db->where('userId', $record->userId);
                        $query = $this->db->get();
                        $row = $query->row(); ?>
                        <tr>
                          <td><?php echo $row->name ?></td>
                          <td><?php echo date('d-m-Y h:i:s A', strtotime($record->date)); ?></td>
                        </tr><?php
                        }
                    } ?>
                  </table>
                </div>

                <div class="box-footer text-right">
                  <a class="btn btn-sm btn-info" href="<?php echo base_url('/factory'); ?>">Back</a>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;
            jQuery("#searchList").attr("action", link);
            jQuery("#searchList").submit();
        });

        jQuery('.datepicker').datepicker({
          autoclose: true,
          format : "dd-mm-yyyy"
        });
        jQuery('.resetFilters').click(function(){
          $(this).closest('form').find("input[type=text]").val("");
        })
    });
</script>
