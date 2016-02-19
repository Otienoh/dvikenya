<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      
      <?php echo form_open('spareparts/update_save',array('class'=>'form-horizontal'));?>
      
     <div class="form-group">
        <?php
        echo form_label('Quantity #','quantity');
        echo form_error('quantity');
        echo form_input(['name' => 'quantity', 'id' => 'quantity' ,'class' => 'form-control', 'placeholder' => 'Enter Additional Quantity ']);
        ?>
      </div>
      
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">UPDATE </button>
     
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>

  
               
