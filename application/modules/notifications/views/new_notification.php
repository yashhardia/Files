<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_NOTIFICATIONS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['list notifications'])) echo $this->phrases['list notifications'];?></a>  &gt;  <?php if(isset($this->phrases['new notification'])) echo $this->phrases['new notification'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
<div class="admin-body">
<div class="inner-elements">
   <div class="col-md-12">
      <div class="panel">
         <div class="panel-heading ele-hea"> <?php if(isset($this->phrases['new notification'])) echo $this->phrases['new notification'];?> <i class="fa fa-plus"></i> </div>
         <div class="panel-body paddig">
            <div class="inner-pages-forms">
			  
               <div class="col-md-6">
                
                  <?php $attributes = array('name'=>'new_notification','id'=>'new_notification');
                     echo form_open(URL_NEW_NOTIFICATIONS,$attributes) ?>
                  <div class="form-group">
                     <label><?php if(isset($this->phrases['title'])) echo $this->phrases['title'];?><span style="color:red;">*</span></label>
                     <?php echo form_input('title',set_value('title')); ?>
                     <?php echo form_error('title'); ?>
                  </div>
				  <div class="form-group">
                     <label><?php if(isset($this->phrases['message'])) echo $this->phrases['message'];?><span style="color:red;">*</span></label>
                    <!-- <textarea class="ckeditor" id="editor1" name="message" cols="1000"  rows="1000">
                     </textarea>-->
                     <?php echo form_textarea('message',set_value('message')); ?>
                     <?php echo form_error('message'); ?>
                  </div>
                  
                  <div class="buttos">
                     
                     <button type="submit" class="butto " name="bttnSave" value="send"><i class="fa fa-paper-plane"></i> <?php if(isset($this->phrases['send'])) echo $this->phrases['send'];?></button>
                     
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--	Validations	-->
<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
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
              $("#new_notification").validate({
				rules: {
					title: {
					  required: true
					},
					message: {
					  required: true
					}                  

				},
   				messages: {
					title: {
						required: "<?php if(isset($this->phrases['title'])) echo $this->phrases['title'].' '.$this->phrases['required'];?>"
					},
					message: {
						required: "<?php if(isset($this->phrases['message'])) echo $this->phrases['message'].' '.$this->phrases['required'];?>"
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
