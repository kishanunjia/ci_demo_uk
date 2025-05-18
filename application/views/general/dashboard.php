<?php
$this->db->select('*');
$this->db->from('tbl_users');
$query = $this->db->get(); 
$users = $query->num_rows();

$this->db->select('*');
$this->db->from('factory_master');
$query = $this->db->get(); 
$factory = $query->num_rows();

$this->db->select('*');
$this->db->from('destination_master');
$query = $this->db->get(); 
$destination = $query->num_rows(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?=$factory;?></h3>
                  <p>Factory</p>
                </div>
                <div class="icon">
                  <i class="fa fa-industry"></i>
                </div>
                <a href="<?php echo base_url(); ?>/factory" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?=$destination;?></h3>
                  <p>Destinations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?=base_url();?>destination" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?=$users;?></h3>
                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6 hide">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Reopened Issue</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
    </section>
</div>