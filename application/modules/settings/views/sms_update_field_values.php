<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_SMS_GATEWAYS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['sms gateways'])) echo $this->phrases['sms gateways'];?></a>  &gt;  <?php if(isset($title)) echo $title;?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
<div class="admin-body">
<div class="inner-elements">
   <div class="col-md-12">
      <div class="panel">
         <div class="panel-heading ele-hea"> <?php if(isset($title)) echo $title;?> <i class="fa fa-plus"></i> </div>
         <div class="panel-body paddig">
            <div class="inner-pages-forms">
			  
               <div class="col-md-6">
                
                  <?php $attributes = array('name'=>'sms_update','id'=>'sms_update');
                     echo form_open('',$attributes) ?>
                     <?php 
                     
                     	foreach($sms_gateway_details as $row):
                     ?>
                  <div class="form-group">
                     <label><?php echo $row->field_name; ?><span style="color:red;">*</span></label>
                     <?php
                     if($row->is_required == 'No') {
							$element = array(
								'type' => 'text',
								'name'	=>	'setting_'.$row->field_id,
								'id'	=>	'setting_'.$row->field_id,
								'value'	=>	(isset($row->field_output_value)) ? $row->field_output_value : '',
							);
						} else {
							$element = array(
								'type' => 'text',
								'name'	=>	'setting_'.$row->field_id,
								'id'	=>	'setting_'.$row->field_id,
								'value'	=>	(isset($row->field_output_value)) ? $row->field_output_value : '',
								'required' => 'required',
							);
						}
						echo form_input($element);
						?>
                  </div>
                  <?php endforeach; ?>
                  <div class="buttos">
                     <button type="submit" class="butto" name="add" value="add"> <?php if(isset($this->phrases['update'])) echo $this->phrases['update'];?></button>
                     
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
