<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12 ">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      
      <?php echo form_open('spareparts/submit',array('class'=>'form-horizontal','role'=>'form'));
      $equipments = array();
      foreach($maequipment as $row ){
      $equipments[$row->id] = $row->name; 
        }
      ?>
      <div class="row"> 
         <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Equipment Model Name</b></label>
                  <?php echo form_dropdown('equipment',$equipments , $equipment, 'id="equipment" class="form-control"  AutoComplete=off');?>
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Spare Part Type</b></label>
                          <select name="etype" id="etype" class="form-control" >
                          <option value="">- Select One  - </option>
                          </select>  
                </div><!--/form-group-->
            </div>
            </div><br/>
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
                  <label><b>Spare Part Manufacturer</b></label>
                  <!-- <input type="text" name="brand"  class="form-control"> -->

                  <?php echo form_input(['name' => 'brand', 'id' => 'brand',  'value' => $brand ,'class' => 'form-control']); ?>

                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>
            
      <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Catalogue #</b></label>
                  <!-- <input type="text" name="catalogue"  class="form-control"> -->
                  <?php echo form_input(['name' => 'catalogue', 'id' => 'catalogue',  'value' => $catalogue ,'class' => 'form-control']); ?>
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Unit Price</b></label>
                  <!-- <input type="text" name="unit_price"  class="form-control"> -->
                  <?php echo form_input(['name' => 'unit_price', 'id' => 'unit_price',  'value' => $unit_price ,'class' => 'form-control']); ?> 
                </div><!--/form-group-->
            </div>
            </div><br/>
            <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Quantity #</b></label>
                  <!-- <input type="text" name="quantity"  class="form-control"> -->
                   <?php echo form_input(['name' => 'quantity', 'id' => 'quantity',  'value' => $quantity ,'class' => 'form-control']); ?>
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Date of Purchase</b></label>
                  <!-- <input type="text" name="date_purchased"  class="form-control "> -->
                   <?php echo form_input(['name' => 'date_purchased', 'id' => 'date_purchased',  'value' => $date_purchased ,'class' => 'form-control']); ?>
                </div><!--/form-group-->
            </div>
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
  <script type="text/javascript">
              $(document).ready(function () { 
                
                //start of equipment
                    $('#equipment').change(function () {

                      console.log("Start change... ");
                    var selEquip = $(this).val();
                    console.log(selEquip);
                    $('#etype').children('#removable').remove();
                    $.get('http://localhost/dvikenya/e_type/ajax_get_etype/'+selEquip , function(data){
                     obj=jQuery.parseJSON(data);
                     console.log(obj);
                      $.each(obj, function(index, value){
            $('#etype').append('<option id="removable" value="'+value.id+'">'+value.name+'</option>');
             console.log(value.name);
          });
                    });
                     
                });
            //End of user equipment assignment

            });
             //End of fun assignment

</script>
               
<!-- 
 <script type="text/javascript">
  $(document).ready(function(){
    $('#sub-county').hide(0);
    $('#county-select').change(function(){
      id=$(this).val();
      if (id==0) {
        $('#sub-county').hide();
      } else{
        $('#sub-county').show();
        $('#sub_county_select').children('#removable').remove();
        $.get('<?php base_url();?>dashboard/ajax_get_sub_county/'+id, function(data){
          obj=jQuery.parseJSON(data);
          
          $.each(obj, function(index, value){
            $('#sub_county_select').append('<option id="removable" value="'+value.sub_county_ID+'">'+value.sub_county_name+'</option>');
            // console.log(value.sub_county_name);
          });
        });
      }
      
    });
  });
 -->