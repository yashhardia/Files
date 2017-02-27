<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
        &gt;  <?php if(isset($this->phrases['Push Notifications'])) echo $this->phrases['Push Notifications'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
<div class="admin-body">
<div class="inner-elements">
   <div class="col-md-12"> 
      <div class="panel">
         <div class="panel-heading ele-hea"> <?php if(isset($this->phrases['Push Notifications'])) echo $this->phrases['Push Notifications'];?> <i class="fa fa-plus"></i> </div>
         <div class="panel-body paddig">
            <div class="inner-pages-forms">
			   <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
               <div class="col-md-6">
               
                  <?php $attributes = array('name'=>'gcm_push_notification','id'=>'gcm_push_notification');
                     echo form_open(URL_PUSH_NOTIFICATIONS,$attributes) ?>
                  <div class="form-group">
                     <label><?php if(isset($this->phrases['one signal server api key'])) echo $this->phrases['one signal server api key'];?><span style="color:red;">*</span></label>
                     <?php echo form_input('one_signal_server_api_key',set_value('one_signal_server_api_key',$gcm_settings->one_signal_server_api_key)); ?>
                     <?php echo form_error('one_signal_server_api_key'); ?>
                  </div>
                <div class="form-group">
                     <label><?php if(isset($this->phrases['one signal app id'])) echo $this->phrases['one signal app id'];?><span style="color:red;">*</span></label>
                     <?php echo form_input('one_signal_app_id',set_value('one_signal_app_id',$gcm_settings->one_signal_app_id)); ?>
                     <?php echo form_error('one_signal_app_id'); ?>
                  </div>	
				  <?php echo form_hidden('update_record_id',set_value('update_record_id',$gcm_settings->id)); ?>
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
              $("#gcm_push_notification").validate({
				rules: {
					gcm_server_api_key: {
					  required: true
					}				                  

				},
   				messages: {
					gcm_server_api_key: {
						required: "<?php if(isset($this->phrases['fcm server api key'])) echo $this->phrases['fcm server api key'].' '.$this->phrases['required'];?>"
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
