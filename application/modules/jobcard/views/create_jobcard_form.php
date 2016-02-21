<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12 ">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');
     echo $this->session->flashdata('Umsg');  

    $equipments = array();
      foreach($maequipment as $row ){
      $equipments[$row->id] = $row->name; 
      }

    ?>


      <?php echo form_open('jobcard/submit',array('class'=>'form-horizontal','role'=>'form'));?>
      <div class="well well-sm"><b>Basic Job Information</b></div>
      <div class="row"> 
    <div class="col-lg-6">
             <div class="control-group">
                  
                   <?php
                    echo form_label('Station Base Level','user_statiton');
                    echo form_error('user_statiton');
                    echo form_input(['name' => 'user_statiton', 'id' => 'user_statiton',  'value' => $user_object['user_statiton'] ,'class' => 'form-control', 'placeholder' => 'Enter Type of Equipment',  'AutoComplete' => 'off']);
                    ?>
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <?php
                    echo form_label('Facility Name','facility');
                    echo form_error('facility');
                    echo form_input(['name' => 'facility', 'id' => 'facility',  'value' => $facility ,'class' => 'form-control', 'placeholder' => 'Enter facility name',  'AutoComplete' => 'off']);
                    ?>
                </div><!--/form-group-->
            </div>
            </div><br/>
            <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
               
                  <?php
                    echo form_label('Equipment Model','equipment');
                    echo form_error('equipment');
                   echo form_dropdown('equipment',$equipments , $equipment, 'id="equipment" class="form-control"  AutoComplete=off');?>
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                 
                  <?php
                    echo form_label('Inventory/Serial No #','serial_id');
                    echo form_error('serial_id');
                    echo form_input(['name' => 'serial_id', 'id' => 'serial_id',  'value' => $serial_id ,'class' => 'form-control', 'placeholder' => 'Inventory/Serial No #',  'AutoComplete' => 'off']);
                    ?>
                </div><!--/form-group-->
            </div>
            </div><br/>
            
     <div class="well well-sm"><b>Equipment Repair Details</b></div>
      <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  
                  <?php
                    echo form_label('Diagnosis (Defects)','deffect');
                    echo form_error('deffect');
                    echo form_textarea(['name' => 'deffect', 'id' => 'deffect',  'value' => $deffect ,'class' => 'form-control', 'placeholder' => 'Diagnosis (Defects)',  'AutoComplete' => 'off']);
                    ?>
                 
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>

            <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                
                  <?php
                    echo form_label('Actions Taken','actions');
                    echo form_error('actions');
                    echo form_textarea(['name' => 'actions', 'id' => 'actions',  'value' => $actions ,'class' => 'form-control', 'placeholder' => 'Actions Taken',  'AutoComplete' => 'off']);
                    ?>
                 
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>
            <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  <label><b>Spare Parts Used</b></label>
                  <!-- <input type="textarea" name="station_base"  class="form-control"> -->
                 <table class="table table-bordered ">
        <thead>
                <tr><td align="center">Item</td><td>Description</td><td>Catalogue No #</td><td>Quantity No #</td></tr>
        </thead>

        <tbody>
              <tr>
              <td align="center">1</td>
              <td><input type="text" name="spare_1" class="form-control"></td>
              <td><input type="text" name="catalogue_1" class="form-control"></td>
              <td><input type="text" name="quantity_1" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">2</td>
              <td><input type="text" name="spare_2" class="form-control"></td>
              <td><input type="text" name="catalogue_2" class="form-control"></td>
              <td><input type="text" name="quantity_2" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">3</td>
              <td><input type="text" name="spare_3" class="form-control"></td>
              <td><input type="text" name="catalogue_3" class="form-control"></td>
              <td><input type="text" name="quantity_3" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">4</td>
              <td><input type="text" name="spare_4" class="form-control"></td>
              <td><input type="text" name="catalogue_4" class="form-control"></td>
              <td><input type="text" name="quantity_4" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">5</td>
              <td><input type="text" name="spare_5" class="form-control"></td>
              <td><input type="text" name="catalogue_5" class="form-control"></td>
              <td><input type="text" name="quantity_5" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">6</td>
              <td><input type="text" name="spare_6" class="form-control"></td>
              <td><input type="text" name="catalogue_6" class="form-control"></td>
              <td><input type="text" name="quantity_6" class="form-control"></td>
              </tr>

        </tbody>
        </table> 
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>
             
            <div class="row"> 
              <div class="col-lg-12">
              <label><b>Reason for Failure</b></label> 
            <div class="control-group">
            <div class="col-lg-6">
          <label class="checkbox-inline"><input type="checkbox" name="reason_defects[]" id="inlinecheckbox1" value="Wear and Tear"> Wear and Tear </label><br/>
          <label class="checkbox-inline"><input type="checkbox" name="reason_defects[]"  id="inlinecheckbox1" value="Contamination"> Contamination </label><br/>
          <label class="checkbox-inline"><input type="checkbox" name="reason_defects[]" id="inlinecheckbox1" value="User Error"> User Error </label><br/>
          
                  </div>
                  <div class="col-lg-6">
          <label class="checkbox-inline"><input type="checkbox" name="reason_defects[]" id="inlinecheckbox1" value="Unstable Mains"> Unstable Mains </label><br/>
          <label class="checkbox-inline"><input type="checkbox" name="reason_defects[]" id="inlinecheckbox1" value="Improper Instalation"> Improper Instalation</label><br/>
          <label class="checkbox-inline"><input type="checkbox" name="reason_defects[]" id="inlinecheckbox1" value="Dirt"> Dirt </label><br/>
         
                  </div>
                </div><!--/form-group--> 
                </div><!--/span-->  
            </div><br/>
              <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                 
                  <?php
                    echo form_label('Any Specific Reasons for Failure','specific_defect');
                    echo form_error('specific_defect');
                    echo form_textarea(['name' => 'specific_defect', 'id' => 'specific_defect',  'value' => $specific_defect ,'class' => 'form-control',  'AutoComplete' => 'off']);
                    ?>
                 
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>
            <div class="well well-sm"><b>Test Administered Before Dispatch</b></div>  
            <div class="row"> 
            <div class="col-lg-12">
              <label class="checkbox-inline"><input type="checkbox" name="test_administered[]" id="inlinecheckbox1" value="Dirt"> Gas Leak </label><br/> 
               <label class="checkbox-inline"><input type="checkbox" name="test_administered[]" id="inlinecheckbox1" value="Temprature within -15C to -25C"> Temprature within -15<sup>o</sup> C to -25<sup>o</sup> C  </label><br/> 
                <label class="checkbox-inline"><input type="checkbox" name="test_administered[]" id="inlinecheckbox1" value="Temprature within +2C to +8C "> Temprature within +2<sup>o</sup> C to +8<sup>o</sup> C </label><br/> 
                 <label class="checkbox-inline"><input type="checkbox" name="test_administered[]" id="inlinecheckbox1" value="Door Seal"> Door Seal </label><br/> 
            </div><br/>
            </div>
            <br/>
            <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  
                  <?php
                    echo form_label('Additional Comments','comments');
                    echo form_error('comments');
                    echo form_textarea(['name' => 'comments', 'id' => 'comments',  'value' => $comments ,'class' => 'form-control',  'AutoComplete' => 'off']);
                    ?>
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>

<div class="well well-sm"><b>Technician Details</b></div>

      <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
            
                   <?php
                    echo form_label('Technician Name','tech_name');
                    echo form_error('tech_name');
                    echo form_input(['name' => 'tech_name', 'id' => 'tech_name',  'value' => $tech_name ,'class' => 'form-control', 'placeholder' => 'Technician Name',  'AutoComplete' => 'off']);
                    ?>
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  
                   <?php
                    echo form_label('Full Name Initials','tech_initials');
                    echo form_error('tech_initials');
                    echo form_input(['name' => 'tech_initials', 'id' => 'tech_initials',  'value' => $tech_initials ,'class' => 'form-control', 'placeholder' => 'Full Name Initials',  'AutoComplete' => 'off']);
                    ?>
                </div><!--/form-group-->
            </div>
            </div><br/>

      <button class="btn btn-lg btn-danger" name="submit" type="submit">Submit</button>
     
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>
