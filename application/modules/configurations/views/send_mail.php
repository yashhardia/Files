<div class="col-md-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_CUSTOMERS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['customers'])) echo $this->phrases['customers'];?></a>  &gt;  <?php if(isset($this->phrases['customer details'])) echo "Send Mail";?>
   </div>
</div>
<div class="col-md-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> Send Mail</div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
                     <ul class="ord">
                        <form action="<?php echo base_url()?>customers/send_mail"method="post"name="send_mail" id="send_mail"accept-charset="utf-8">
                          <li><h4>Name</h4></li>
                            <li><input style="width:500px"type="text"id="name"name="name"value="<?php echo $usersDetails->first_name;?>"readonly></li>
                               <li><h4>Email</h4></li>
                                <li><input style="width:500px"type="text"id="email"name="email"value="<?php echo $usersDetails->email;?>"readonly></li>
                                   <li><h4>Message</h4></li>
                                <li><input style="width:500px"type="text"id="message"name="message"> </li>   
                               <li><h4>Description</h4></li>
                            <li><input style="width:500px"type="text"id="description"name="description"></li>
                         <li><input type="submit"value="Send"></li>
                        </form>                    
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
