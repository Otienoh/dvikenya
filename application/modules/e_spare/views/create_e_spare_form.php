<?php defined('BASEPATH') OR exit('No direct script access allowed');?>  
<div class="row">
  <div class="col-lg-12 col-sm-12">
    <div class="panel default blue_title h2">
      <div class="panel-body">
        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#tab1"><b>Add New Spare Part Name</b></a></li>
          <li><a data-toggle="tab" href="#tab2"><b>Spare Parts Names </b></a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div id="tab1" class="tab-pane fade in active">

            <br><br>
            <div class="col-lg-6 col-lg-offset-3">
                  <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');
                    
                    $array = array();
                    foreach($maequipment as $row ){
                    $array[$row->id] = $row->name; 
                      }

                       $type = array();
                    foreach($matype as $row ){
                    $type[$row->id] = $row->name; 
                      }
                    ?>
                 <!-- SELECT `id`, `name`, `equipment_model`, `sparepart_type` FROM `m_sparepart_name` WHERE 1 -->
                  <?php echo form_open('e_spare/submit',array('class'=>'form-horizontal'));?>
                  <div class="form-group">
                    <?php
                    echo form_label('Equipment Model Name','equipment_model');
                    echo form_error('equipment_model');
                    echo form_dropdown('equipment_model',$array , $equipment_model, 'id="equipment_model" class="form-control"  AutoComplete=off'); 
                    ?>
                  </div>

                   <div class="form-group">
                    <?php
                    echo form_label('Spare Part Type','sparepart_type');
                    echo form_error('sparepart_type');
                    echo form_dropdown('sparepart_type',$type , $sparepart_type, 'id="sparepart_type" class="form-control"  AutoComplete=off'); 
                    ?>
                  </div>
                  

                  <div class="form-group">
                    <?php
                    echo form_label('Spare Part Name','name');
                    echo form_error('name');
                    echo form_input(['name' => 'name', 'id' => 'name',  'value' => $name ,'class' => 'form-control', 'placeholder' => 'Enter Name of Equipment',  'AutoComplete' => 'off']);
                    ?>
                  </div>
                   
                
                  <button class="btn btn-lg btn-danger " name="submit" type="submit">SUBMIT</button>
                   <a class="btn btn-lg btn-info " href="<?php echo site_url('spareparts');?>">CANCEL</a>
                 
                  <?php 
                  if (isset($update_id)){
                      echo form_hidden('update_id', $update_id);
                  }
                  echo form_close();?>
            </div> 


            
          </div>
          <div id="tab2" class="tab-pane fade">
           
            
            <br>
            <?php echo $this->session->flashdata('msg');  ?>
            <br>  
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Equipment ID</th>
                        <th>Equipment Model Name</th>
                        <th>Spare Part Type</th>
                        <td align="center"><b>Edit</b></td>
                        <td align="center"><b>Delete</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($records->result() as $row){
                        $edit_url = base_url().'e_name/create/'.$row->id;
                        $delete_url = base_url().'e_name/delete/'.$row->id;
                      ?>
                    <tr>
                        <td><?php echo $row->id ?></td>
                        <td><?php echo $row->equipment ?></td>
                        <td><?php echo $row->equipment_type ?></td>
                        <td align="center"><a href="<?php echo $edit_url ?>"><i class="fa fa-edit"></i></a></td>
                        <td align="center"><a href="<?php echo $delete_url ?>"><i class="fa fa-trash-o"></i></td>
                       
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
                <hr>
              </br>

              <?php 

                    //echo $this->table->generate($records);
              echo $this->pagination->create_links(); ?>
            </div>    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
