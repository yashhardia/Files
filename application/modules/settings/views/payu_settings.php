<div class="col-md-10 paddigcol-sm-10 ">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['master settings'])) echo $this->phrases['master settings'];?> &gt;<?php if(isset($this->phrases['payu settings'])) echo $this->phrases['payu settings'];?> 
   </div>
</div>
<div class="col-md-10 col-sm-10">
<div class="admin-body">
<div class="inner-elements">
   <div class="panel">
      <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
      <div class="panel-heading ele-hea"> <?php if(isset($this->phrases['payu settings'])) echo $this->phrases['payu settings'];?> </div>
      <div class="panel-body paddig">
         <div class="inner-pages-forms">
            <?php 
               $attributes = array('name' => 'payu_settings_form', 'id' => 'payu_settings_form');
               echo form_open(URL_PAYU_SETTINGS,$attributes) ?>
            <div class="col-md-6">
               <div class="form-group">                    
                  <label>
				  <?php if(isset($this->phrases['merchant key'])) echo $this->phrases['merchant key'];?><span style="color:red;">*</span></label>
                  <?php echo form_input('merchant_key',set_value('merchant_key',$payu_settings->merchant_key)); ?>
                  <?php echo form_error('merchant_key'); ?>
               </div>
			   <div class="form-group">                    
                  <label>
				  <?php if(isset($this->phrases['salt'])) echo $this->phrases['salt'];?><span style="color:red;">*</span></label>
                  <?php echo form_input('salt',set_value('salt',$payu_settings->salt)); ?>
                  <?php echo form_error('salt'); ?>
               </div>
               <div class="form-group">                    
                  <label><?php if(isset($this->phrases['live URL'])) echo $this->phrases['live URL'];?><span style="color:red;">*</span></label>
                  <?php echo form_input('live_url',set_value('live_url',$payu_settings->live_url)); ?>
                  <?php echo form_error('live_url'); ?>
               </div>
			   <div class="form-group">                    
                  <label><?php if(isset($this->phrases['test URL'])) echo $this->phrases['test URL'];?><span style="color:red;">*</span></label>
                  <?php echo form_input('test_url',set_value('test_url',$payu_settings->test_url)); ?>
                  <?php echo form_error('test_url'); ?>
               </div>
			   <div class="form-group">
                  <label><?php if(isset($this->phrases['account_type'])) echo $this->phrases['account_type'];?><span style="color:red;">*</span></label>
                  <?php 
						$options = array(
						  'test'  => (isset($this->phrases['test'])) ? $this->phrases['test'] : 'Test',
						  'live'    => (isset($this->phrases['live'])) ? $this->phrases['live'] : 'Live'
						  );
                     
                      $select = "";
                     if(isset($payu_settings->account_type))
                     $select = $payu_settings->account_type;
                     
                     echo form_dropdown('account_type', $options,$select,'class="chzn-select"'); ?>
                  <?php echo form_error('account_type'); ?>
               </div>
               <div class="form-group">
                  <label><?php echo $this->phrases['status']?><span style="color:red;">*</span></label>
                  <?php 
						$options = array(
						  'Active'  => (isset($this->phrases['active'])) ? $this->phrases['active'] : 'Active',
						  'Inactive'    => (isset($this->phrases['inactive'])) ? $this->phrases['inactive'] : 'Active'
						  );
                     
                     
                      $select = "";
                     if(isset($payu_settings->status))
                     $select = $payu_settings->status;
                     
                     echo form_dropdown('status', $options,$select,'class="chzn-select"'); ?>
                  <?php echo form_error('status'); ?>
               </div>
               <?php echo form_hidden('update_rec_id',set_value('update_rec_id',$payu_settings->payu_id)); ?>
               <div class="buttos">
                  <?php echo form_submit('update',$this->phrases['update'],'class="butto"'); ?>
               </div>
               
            </div>
            <?php echo form_close();?>          
         </div>
      </div>
   </div>
</div>
<!--	Validations	-->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript"> 
   (function($, W, D) {
     var JQUERY4U = {};
     JQUERY4U.UTIL = {
         setupFormValidation: function() {
             //Additional Methods			
             
             //form validation rules
             $("#payu_settings_form").validate({
				 rules: {
                     merchant_key: {
                     	required: true
                     },
                     salt: {
                     	required: true
                     },
                     live_url: {
                     	required: true,
						url:true
                     },
                     test_url: {
                     	required: true,
                     	url:true
                     }
                 },
                 messages: {
                 	merchant_key:{
   		   			required:"<?php if(isset($this->phrases['merchant key'])) echo $this->phrases['merchant key'].' '.$this->phrases['required'];?>"				
					},
					salt:{
						required:"<?php if(isset($this->phrases['salt'])) echo $this->phrases['salt'].' '.$this->phrases['required'];?>"				
					},
					live_url:{
						required:"<?php if(isset($this->phrases['live URL'])) echo $this->phrases['live URL'].' '.$this->phrases['required'];?>"				
					},
					test_url:{
						required:"<?php if(isset($this->phrases['test URL'])) echo $this->phrases['test URL'].' '.$this->phrases['required'];?>"
						
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
