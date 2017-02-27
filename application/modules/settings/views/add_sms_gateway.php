<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_SMS_GATEWAYS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['sms gateways'])) echo $this->phrases['sms gateways'];?></a>  &gt;  <?php if(isset($this->phrases['add sms gateway'])) echo $this->phrases['add sms gateway'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
<div class="admin-body">
<div class="inner-elements">
   <div class="col-md-12"> 
      <div class="panel">
         <div class="panel-heading ele-hea"> <?php if(isset($this->phrases['add sms gateway'])) echo $this->phrases['add sms gateway'];?> <i class="fa fa-plus"></i> </div>
         <div class="panel-body paddig">
            <div class="inner-pages-forms">
			  
               <div class="col-md-6">
                
                  <?php $attributes = array('name'=>'add_sms_gateway','id'=>'add_sms_gateway');
                     echo form_open_multipart(URL_ADD_SMS_GATEWAY,$attributes) ?>
                  <div class="form-group">
                     <label><?php if(isset($this->phrases['sms gateway name'])) echo $this->phrases['sms gateway name'];?><span style="color:red;">*</span></label>
                     <?php echo form_input('sms_gateway_name',set_value('sms_gateway_name')); ?>
                     <?php echo form_error('sms_gateway_name'); ?>
                  </div>
				  <div class="form-group">
                     <label><?php if(isset($this->phrases['is default'])) echo $this->phrases['is default'];?><span style="color:red;">*</span></label>
                      <?php $options = array(
							  'Yes'  => (isset($this->phrases['yes'])) ? $this->phrases['yes'] : 'Yes',
                              'No'    => (isset($this->phrases['no'])) ? $this->phrases['no'] : 'No'
                              );
                        
                        $select = set_value('is_default');
                        
                        echo form_dropdown('is_default', $options,$select,'class="chzn-select"'); ?>
                  </div>
                                                    
				  <div class="form-group">
                     <label><?php if(isset($this->phrases['status'])) echo $this->phrases['status']; ?></label>
                     <?php $options = array(
							  'Active'  => (isset($this->phrases['active'])) ? $this->phrases['active'] : 'Active',
                              'Inactive'    => (isset($this->phrases['inactive'])) ? $this->phrases['inactive'] : 'Active'
                              );
                        
                        $select = set_value('status');
                        
                        echo form_dropdown('status', $options,$select,'class="chzn-select"'); ?>
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
              $("#add_sms_gateway").validate({
				rules: {
					sms_gateway_name: {
					  required: true
					}				                  

				},
   				messages: {
					sms_gateway_name: {
						required: "<?php if(isset($this->phrases['sms gateway name'])) echo $this->phrases['sms gateway name'].' '.$this->phrases['required'];?>"
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
