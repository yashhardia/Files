<!DOCTYPE html>  
<html lang="en">
   <head>
      
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php 
         if(isset($site_settings->site_title) && $site_settings->site_title != "") {
         	echo $site_settings->site_title;
         } 
         else
         {
         	echo "Restaurant";
         }?></title>
      <link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
      <script src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script> 
      <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
     
   </head>
   <body>
      <div class="wrapper">
         <div class="login">
          
            <div class="textf">
               <!-- Auth Form-->
               <h1><?php if(isset($this->phrases['login'])) echo $this->phrases['login'];?></h1>
               <div id="infoMessage"><?php echo $message;?></div>
			    <?php $attributes = array('name'=>'login','id'=>'login');
                     echo form_open(URL_LOGIN,$attributes) ?>
               
               <div class="col-md-12 clearfix"> 
                  <label>  <?php if(isset($this->phrases['email'])) echo $this->phrases['email'];?>   </label>
                  <?php echo form_input('identity',set_value('identity'));?>
                  <?php echo form_error('identity');?>
               </div>
               <div class="col-md-12"> 
                  <label> <?php if(isset($this->phrases['password'])) echo $this->phrases['password'];?></label>
                  <?php echo form_password('password');?>
                  <?php echo form_error('password');?>
               </div>
               <button type="submit" class="lobt"><?php if(isset($this->phrases['login'])) echo $this->phrases['login'];?></button>
               <?php echo form_close();?>
               <!-- Auth Form End-->
            </div>
         </div>
      </div>
	  
   </body>
</html>
