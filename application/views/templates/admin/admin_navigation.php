<div class="left-side" style="width:200px;margin-left:auto; margin-right:0;">
   <div id="cssmenu" style="width:200px;margin-left:auto; margin-right:0;">
       <ul>
       <li <?php if(isset($active_class)){ if($active_class==ACTIVE_DASHBOARD) echo 'class="active"'; }?>><a href="<?php echo site_url().URL_ADMIN;?>"><span> <i class="fa fa-home"/></i> 
            <?php if(isset($this->phrases['dashboard'])) echo $this->phrases['dashboard'];?></span></a>
         </li>
         <li <?php if(isset($active_class) && $active_class==ACTIVE_MENU) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa fa-balance-scale"></i> <?php if(isset($this->phrases['menu'])) echo $this->phrases['menu'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_ADD_MENU; ?>"><span><?php if(isset($this->phrases['add menu'])) echo $this->phrases['add menu'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ADMIN_MENU; ?>"><span><?php if(isset($this->phrases['view menu'])) echo $this->phrases['view menu'];?></span></a></li>
            </ul>
         </li>
         
         <!-- ITEMS -->
         <li <?php if(isset($active_class) && $active_class==ACTIVE_ITEMS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa  fa-asterisk"></i> <?php if(isset($this->phrases['items'])) echo $this->phrases['items'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_ADD_ITEMS; ?>"><span><?php if(isset($this->phrases['add item'])) echo $this->phrases['add item'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ADMIN_ITEMS; ?>"><span><?php if(isset($this->phrases['view items'])) echo $this->phrases['view items'];?></span></a></li>
            </ul>
         </li>
         <!-- ITEMS -->
		 <!--Ratings-->
        <li <?php if(isset($active_class)){ if($active_class==ACTIVE_RATING) echo 'class="has-sub active"'; else echo 'class="has-sub"';}?>>
            <a href="<?php echo base_url().URL_FOOD_RATINGS; ?>"><span> <i class="glyphicon glyphicon-heart"></i> 
            <?php if(isset($this->phrases['ratings'])) echo $this->phrases['rating'];?></span></a>
            <ul class="bb">
            <li><a href="<?php echo base_url().URL_FOOD_RATINGS; ?>"><span><?php if(isset($this->phrases['food rating'])) echo $this->phrases['food rating'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_RESTAURANT_RATING; ?>"><span><?php if(isset($this->phrases['restaurant rating'])) echo $this->phrases['restaurant rating'];?></span></a></li>
            </ul>         
         </li>
        <!--Ratings End-->
         <!-- ADDONS START -->
		 <li <?php if(isset($active_class) && $active_class==ACTIVE_ADDONS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa  fa-plus"></i> <?php if(isset($this->phrases['addons'])) echo $this->phrases['addons'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_ADD_ADDON; ?>"><span><?php if(isset($this->phrases['add addon'])) echo $this->phrases['add addon'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ADMIN_ADDONS; ?>"><span><?php if(isset($this->phrases['view addons'])) echo $this->phrases['view addons'];?></span></a></li>
            </ul>
         </li>
         <!-- ADDONS END -->
		 <!-- OPTIONS START -->
		 <li <?php if(isset($active_class) && $active_class==ACTIVE_OPTIONS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa fa-filter"></i> <?php if(isset($this->phrases['options'])) echo $this->phrases['options'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_ADD_OPTION; ?>"><span><?php if(isset($this->phrases['add option'])) echo $this->phrases['add option'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ADMIN_OPTIONS; ?>"><span><?php if(isset($this->phrases['view options'])) echo $this->phrases['view options'];?></span></a></li>
            </ul>
         </li>
         <!-- OPTIONS END -->
		 <!-- INFOTAINMENT START-->

               <li <?php if(isset($active_class) && $active_class==ACTIVE_INFOTAINMENT) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="glyphicon glyphicon-headphones"></i> Infotainment</span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_CREATE_CATEGORY; ?>"><span><?php if(isset($this->phrases['add category'])) echo $this->phrases['add category'];?></span></a></li> 
<li><a href="<?php echo base_url().URL_VIEW_CATEGORY; ?>"><span><?php if(isset($this->phrases['view category'])) echo $this->phrases['view category'];?></span></a></li>
               
                   <li><a href="<?php echo base_url().URL_VIEW_LIST; ?>"><span><?php if(isset($this->phrases['view list'])) echo $this->phrases['view list'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ADD_MEDIA; ?>"><span><?php if(isset($this->phrases['add media'])) echo $this->phrases['add media'];?></span></a></li>
            </ul>
         </li>
         <!-- INFOTAINMENT END-->
         <li <?php if(isset($active_class)){ if($active_class==ACTIVE_REPORTS)  echo 'class="has-sub active"'; }?>>
            <a href="<?php echo base_url().URL_REPORT; ?>"><span> <i class="glyphicon glyphicon-eye-open"></i> <?php if(isset($this->phrases['reports'])) echo $this->phrases['reports'];?></span></a>
            
         </li>
    
         <!--Offers -->
         <li <?php if(isset($active_class) && $active_class==ACTIVE_OFFERS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa fa-braille"></i> <?php if(isset($this->phrases['offers'])) echo $this->phrases['offers'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_CREATE_OFFER; ?>"><span><?php if(isset($this->phrases['create offer'])) echo $this->phrases['create offer'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ADMIN_OFFERS; ?>"><span><?php if(isset($this->phrases['view offers'])) echo $this->phrases['view offers'];?></span></a></li>
            </ul>
         </li>
         <!--Orders -->
         <li <?php if(isset($active_class) && $active_class==ACTIVE_ORDERS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa  fa-legal"></i> <?php if(isset($this->phrases['orders'])) echo $this->phrases['orders'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_ORDERS; ?>"><span><?php if(isset($this->phrases['new orders'])) echo $this->phrases['new orders'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ORDERS_INDEX.PROCESS; ?>"><span><?php if(isset($this->phrases['under process orders'])) echo $this->phrases['under process orders'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ORDERS_INDEX.DELIVERED; ?>"><span><?php if(isset($this->phrases['delivered orders'])) echo $this->phrases['delivered orders'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_ORDERS_INDEX.CANCELLED; ?>"><span><?php if(isset($this->phrases['cancelled orders'])) echo $this->phrases['cancelled orders'];?></span></a></li>
            </ul>
         </li>
         <!-- Orders -->  
         	
         <!--Users -->
		 <!--<li <?php if(isset($active_class)){ if($active_class==ACTIVE_USERS) echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_ADMIN_USERS; ?>"><span> <i class="fa fa-users"></i> <?php if(isset($this->phrases['users'])) echo $this->phrases['users'];?></span></a>
            
         </li>-->
          <!--Users -->
		 <li <?php if(isset($active_class)){ if($active_class==ACTIVE_CUSTOMERS) echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_CUSTOMERS; ?>"><span> <i class="fa fa-users"></i> <?php if(isset($this->phrases['customers'])) echo $this->phrases['customers'];?></span></a>
            
         </li>
         <!--Galery-->
		  <li <?php if(isset($active_class)){ if($active_class==ACTIVE_GALLERY) echo 'class="active"'; }?>>
           <a href="<?php echo base_url().URL_GALLERY; ?>"><span><i class="fa fa-photo"></i> 
            <?php if(isset($this->phrases['gallery'])) echo $this->phrases['gallery'];?></span></a>
			
         </li>
		 
         <!--Galery end-->
         <!--Raise Concern-->
        <li <?php if(isset($active_class)){ if($active_class==ACTIVE_CONCERNS)  echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_CONCERNS; ?>"><span> <i class="glyphicon glyphicon-pencil"></i> 
            <?php if(isset($this->phrases['raise concern'])) echo $this->phrases['raise concern'];?></span></a>           
         </li>
        <!--Raise Concern-->
         <!-- Notification Center -->
         <li <?php if(isset($active_class) && $active_class==ACTIVE_NOTIFICATIONS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
		 
          <a href="#"><span> <i class="fa fa-mixcloud"></i> <?php if(isset($this->phrases['notifications'])) echo $this->phrases['notifications'];?></span></a>
            <ul class="bb">
              
              <li><a href="<?php echo base_url().URL_NEW_NOTIFICATIONS; ?>"><?php if(isset($this->phrases['new notification'])) echo $this->phrases['new notification'];?></a></li>
              <li><a href="<?php echo base_url().URL_NOTIFICATIONS; ?>"><?php if(isset($this->phrases['list notifications'])) echo $this->phrases['list notifications'];?></a></li>
           
            </ul>
          </li>
         <!--End Notification Center -->
		 <!--language settings-->
		 <li <?php if(isset($active_class) && $active_class==ACTIVE_LANGUAGES) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
		 
          <a href="#"><span> <i class="fa fa-language"></i> <?php if(isset($this->phrases['language settings'])) echo $this->phrases['language settings'];?></span></a>
            <ul class="bb">
              <li><a href="<?php echo base_url().URL_LANGUAGES; ?>"><?php if(isset($this->phrases['list languages'])) echo $this->phrases['list languages'];?></a></li>
              <li><a href="<?php echo base_url().URL_PHRASES; ?>"><?php if(isset($this->phrases['list phrases'])) echo $this->phrases['list phrases'];?></a></li>
              		<li><a href="<?php echo base_url().URL_ADMIN_ADD_LANG;?>"><?php if(isset($this->phrases['add language'])) echo $this->phrases['add language'];?></a></li>
              <li><a href="<?php echo base_url().URL_ADMIN_ADD_PHRASE;?>"><?php if(isset($this->phrases['add phrase'])) echo $this->phrases['add phrase'];?></a></li>
            
            </ul>
          </li>
		  <!--Language settings end-->
        
            <!-- CONFIGURATIONS -->
		 <li <?php if(isset($active_class) && $active_class==ACTIVE_CONFIGURATIONS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa fa-filter"></i> <?php if(isset($this->phrases['configurations'])) echo $this->phrases['configurations'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_CONFIGURATIONS; ?>"><span><?php if(isset($this->phrases['configurations'])) echo $this->phrases['configurations'];?></span></a></li>
            </ul>
         </li>
         <!-- CONFIGURATIONS END -->
        <!--Tax Management-->
        <li <?php if(isset($active_class)){ if($active_class==ACTIVE_TAX_MANAGEMENT)  echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_TAX_MANAGEMENT; ?>"><span> <i class="glyphicon glyphicon-pencil"></i> <?php if(isset($this->phrases['tax management'])) echo        $this->phrases['tax management'];?></span></a>
            
         </li>
        <!--Tax Management-->
         <!--Master settings  -->
		  <li <?php if(isset($active_class) && $active_class==ACTIVE_MASTER_SETTINGS) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
         
            <a href="#"><span> <i class="fa fa-cogs"></i> <?php if(isset($this->phrases['master settings'])) echo $this->phrases['master settings'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_SITE_SETTINGS; ?>"><?php if(isset($this->phrases['app settings'])) echo $this->phrases['app settings'];?></a></li>
               <li><a href="<?php echo base_url().URL_PAYPAL_SETTINGS; ?>"><?php if(isset($this->phrases['paypal settings'])) echo $this->phrases['paypal settings'];?></a></li>
               <li><a href="<?php echo base_url().URL_PAYU_SETTINGS; ?>"><?php if(isset($this->phrases['payu settings'])) echo $this->phrases['payu settings'];?></a></li>
               <li><a href="<?php echo base_url().URL_EMAIL_SETTINGS; ?>"><?php if(isset($this->phrases['email settings'])) echo $this->phrases['email settings'];?></a></li>
               <li><a href="<?php echo base_url().URL_EMAIL_TEMPLATE_SETTINGS; ?>"><?php if(isset($this->phrases['email templates'])) echo $this->phrases['email templates'];?></a></li>
               <li><a href="<?php echo base_url().URL_SMS_GATEWAYS; ?>"><?php if(isset($this->phrases['sms gateways'])) echo $this->phrases['sms gateways'];?></a></li>
               <li><a href="<?php echo base_url().URL_SMS_TEMPLATES; ?>"><?php if(isset($this->phrases['sms templates'])) echo $this->phrases['sms templates'];?></a></li>
               <li><a href="<?php echo base_url().URL_PUSH_NOTIFICATIONS; ?>"><?php if(isset($this->phrases['Push Notifications'])) echo $this->phrases['Push Notifications'];?></a></li>
               
            </ul>
         </li>
         
         <!--Master settings navigation end -->
		 <!-- Static Pages -->
		  <li <?php if(isset($active_class) && $active_class==ACTIVE_PAGES) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
            <a href="#"><span> <i class="fa fa-file-o"></i> <?php if(isset($this->phrases['pages'])) echo $this->phrases['pages'];?></span></a>
            <ul class="bb">
               <li><a href="<?php echo base_url().URL_PAGE; ?>1"><?php if(isset($this->phrases['about us'])) echo $this->phrases['about us'];?></a></li>
               <li><a href="<?php echo base_url().URL_PAGE; ?>2"><?php if(isset($this->phrases['how it works'])) echo $this->phrases['how it works'];?></a></li>
               <li><a href="<?php echo base_url().URL_PAGE;?>3"><span><?php if(isset($this->phrases['terms and conditions'])) echo $this->phrases['terms and conditions'];?></span></a></li>
               <li><a href="<?php echo base_url().URL_PAGE;?>4"><span><?php if(isset($this->phrases['privacy and policy'])) echo $this->phrases['privacy and policy'];?></span></a></li>
            </ul>
         </li>
		 <!-- Static Pages End-->
		 <!--Location Master  -->
		 <li <?php if(isset($active_class) && $active_class==ACTIVE_LOCATION) echo 'class="has-sub active"'; else echo 'class="has-sub"'; ?>>
         
            <a href="#"><span> <i class="fa  fa-map-marker"></i> <?php if(isset($this->phrases['location master'])) echo $this->phrases['location master'];?></span></a>
            <ul class="bb">
                <li><a href="<?php echo base_url().URL_CITIES; ?>"><?php if(isset($this->phrases['cities'])) echo $this->phrases['cities'];?></a></li>
               <li><a href="<?php echo base_url().URL_SERVICE_LOCATIONS;?>"><span><?php if(isset($this->phrases['service delivery locations'])) echo $this->phrases['service delivery locations'];?></span></a></li>
            </ul>
         </li>
         <!--Master settings navigation end -->
        
<!--Inventory-->
<li <?php if(isset($active_class)){ if($active_class==ACTIVE_INVENTORY)  echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_INVENTORY; ?>"><span> <i class="glyphicon glyphicon-usd"></i> <?php if(isset($this->phrases['inventory'])) echo $this->phrases['inventory'];?></span></a>           
         </li>
<!--Inventory End-->

<!--Review-->
<li <?php if(isset($active_class)){ if($active_class==ACTIVE_REVIEW)  echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_REVIEW; ?>"><span> <i class="glyphicon glyphicon-star"></i> <?php if(isset($this->phrases['review'])) echo $this->phrases['review'];?></span></a>           
         </li>
<!--Review end-->
<!--Promotion-->
<li <?php if(isset($active_class)){ if($active_class==ACTIVE_PROMOTION)  echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_PROMOTION; ?>"><span> <i class="glyphicon glyphicon-bullhorn"></i> <?php if(isset($this->phrases['promotion'])) echo $this->phrases['promotion'];?></span></a>           
         </li>
<!--Promotion-->    
<li<?php if(isset($active_class)){ if($active_class==ACTIVE_ABOUT_US)  echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_ABOUT_US; ?>"><span> <i class="glyphicon glyphicon-user"></i> <?php if(isset($this->phrases['about us'])) echo $this->phrases['about us'];?></span></a></li>
<li<?php if(isset($active_class)){ if($active_class==ACTIVE_TERMS_AND_CONDITION)  echo 'class="active"'; }?>>
            <a href="<?php echo base_url().URL_TERMS_AND_CONDITION; ?>"><span> <i class="glyphicon glyphicon-folder-close"></i> <?php if(isset($this->phrases['terms and condition'])) echo $this->phrases['terms and condition'];?></span></a></li>
      </ul>
   </div>
</div>
<div class="bll"></div>
</div>
