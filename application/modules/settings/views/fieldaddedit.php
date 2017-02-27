<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_ADMIN_MENU;?>" style="text-decoration:none;"><?php if(isset($this->phrases['fields'])) echo $this->phrases['fields'];?></a>  &gt;  <?php if(isset($this->phrases['add field'])) echo $this->phrases['add field'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
<div class="admin-body">
<div class="inner-elements">
   <div class="col-md-12">
      <div class="panel">
         <div class="panel-heading ele-hea"> <?php if(isset($this->phrases['add field'])) echo $this->phrases['add field'];?> <i class="fa fa-plus"></i> </div>
         <div class="panel-body paddig">
            <div class="inner-pages-forms">
			  
               <div class="col-md-6">
                
                  <?php $attributes = array('name'=>'field_add_edit','id'=>'field_add_edit');
                     echo form_open(URL_ADD_SMS_FIELDS,$attributes) ?>
                  <div class="form-group">
                     <label><?php if(isset($this->phrases['field name'])) echo $this->phrases['field name'];?><span style="color:red;">*</span></label>
                     <?php echo form_input('field_name',set_value('field_name')); ?>
                     <?php echo form_error('field_name'); ?>
                  </div>
				  <div class="form-group">
                     <label><?php if(isset($this->phrases['value'])) echo $this->phrases['value'];?><span style="color:red;">*</span></label>
                     <?php echo form_input('field_output_value',set_value('field_output_value')); ?>
                     <?php echo form_error('field_output_value'); ?>
                  </div>
                  <div class="form-group">
                     <label><?php if(isset($this->phrases['sms gateways'])) echo $this->phrases['sms gateways'];?><span style="color:red;">*</span></label>
					<?php $options = $sms_gateways;
                        
                        $select = set_value('sms_gateway_id');
                        
                        echo form_dropdown('sms_gateway_id', $options,$select,'class="chzn-select"'); ?>	
                  </div>
                  <div class="form-group">
                     <label><?php if(isset($this->phrases['is required'])) echo $this->phrases['is required'];?><span style="color:red;">*</span></label>
                     <?php $options = array(
							  'Yes'  => (isset($this->phrases['yes'])) ? $this->phrases['yes'] : 'Yes',
                              'No'    => (isset($this->phrases['no'])) ? $this->phrases['no'] : 'No'
                              );
                        
                        $select = set_value('is_required');
                        
                        echo form_dropdown('is_required', $options,$select,'class="chzn-select"'); ?>
                  </div>
                 
				  
                  <div class="buttos">
                     <button type="submit" class="butto" name="add" value="add"><i class="fa fa-plus"></i> <?php if(isset($this->phrases['add'])) echo $this->phrases['add'];?></button>
                     
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--	Validations	-->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/js/additional-methods.js"></script>
<script type="text/javascript"> 
   (function($,W,D)
   {
      var JQUERY4U = {};
   
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {
              
   		
   		//form validation rules
              $("#field_add_edit").validate({
              	ignore:" ",
				rules: {
					field_name: {
					  required: true
					},
					field_output_value: {
					  required: true
					},
					sms_gateway:{
						required:true
					}                

				},
   				messages: {
					field_name: {
						required: "<?php if(isset($this->phrases['field name'])) echo $this->phrases['field name'].' '.$this->phrases['required'];?>"
					},
					field_output_value: {
						required: "<?php if(isset($this->phrases['value'])) echo $this->phrases['value'].' '.$this->phrases['required'];?>"
					},
					sms_gateway:{
						required:"<?php if(isset($this->phrases['sms gateway'])) echo $this->phrases['sms gateway'].' '.$this->phrases['required'];?>"
					}
   				
   			},
                  
                  submitHandler: function(form) {
                      form.submit();
                  }
              });
          }
      }
   
      //when the dom has loaded setup form validation rules
      $(D).ready(function($) {
          JQUERY4U.UTIL.setupFormValidation();
      });
   
   })(jQuery, window, document);
</script>
