<!DOCTYPE html>  
<html lang="en">
   <head>
      <title><?php 
        if(isset($site_settings->site_title) && $site_settings->site_title != "") {
         	echo $site_settings->site_title;
         } 
         else
         {
         	echo "Restaurant";
         }?>
	</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
      <script src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script> 
      <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
   </head>
   <body>
      <div class="wrapper">
         <div class="login">
            <div class="lg"></div>
            <div class="textf">
               <!-- Auth Form-->
               <h1><?php if(isset($this->phrases['reset password'])) echo $this->phrases['reset password'];?></h1>
               <div id="infoMessage"><?php echo $message;?></div>
               <?php echo form_open(URL_RESET_PASSWORD.DS.$code,'id="reset_password_form"');?>
               <div class="col-md-12"> 
                  <label>  <?php if(isset($this->phrases['new password'])) echo $this->phrases['new password'];?>   </label>
                   <?php echo form_input($new_password);?> 
				   <?php echo form_error('new_password');?>
               </div>
               <div class="col-md-12"> 
                  <label> <?php if(isset($this->phrases['confirm new password'])) echo $this->phrases['confirm new password'];?></label>
                  <?php echo form_input($new_password_confirm);?>
					<?php echo form_error('new_confirm');?>
               </div>
                 <?php echo form_hidden($user_id);?>
                 <?php echo form_hidden($csrf);?>
               <button type="submit" class="lobt"><?php if(isset($this->phrases['change password'])) echo $this->phrases['change password'];?></button>
               <?php echo form_close();?>
               <!-- Auth Form End-->
            </div>
         </div>
      </div>
   </body>
</html>