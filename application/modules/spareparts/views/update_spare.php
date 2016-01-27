<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12 ">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      
      <?php echo form_open('spareparts/submit',array('class'=>'form-horizontal','role'=>'form')); ?>
            <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Spare Part Name</b></label>
                  <!-- <input type="text" name="e_name" placeholder="Enter Spare Part Name " class="form-control"> -->
           <?php echo form_input(['name' => 'e_name', 'id' => 'e_name',  'value' => $e_name ,'class' => 'form-control']); ?>
                </div><!--/form-group-->
            </div><!--/span-->
              
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Quantity #</b></label>
                  <!-- <input type="text" name="quantity"  class="form-control"> -->
                   <?php echo form_input(['name' => 'quantity', 'id' => 'quantity',  'value' => $quantity ,'class' => 'form-control']); ?>
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>

      <button class="btn btn-lg btn-danger" name="submit" type="submit">Submit</button>
      <a class="btn btn-lg btn-info " href="<?php echo site_url('spareparts');?>">CANCEL</a>
     
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>

               
