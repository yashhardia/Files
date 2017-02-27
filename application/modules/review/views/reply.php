<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_review;?>" style="text-decoration:none;"><?php if(isset($this->phrases['review'])) echo $this->phrases['review'];?></a>  &gt;  <?php if(isset($this->phrases['reply'])) echo "Reply";?>
   </div>
</div>
<div class="col-md-10 col-sm-10 ">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea">Reply</div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
                     <ul class="ord">
                        <form action="<?php echo base_url()?>customers/send_mail"method="post"name="send_mail" id="send_mail"accept-charset="utf-8">
                          <li><h4>User Name</h4></li>
                            <li><input style="width:500px"type="text"id="name"name="name"value="<?php echo $result['user_name']?>"readonly></li>
                               <li><h4>Table Id</h4></li>
                                <li><input style="width:500px"type="text"id="email"name="email"value="<?php echo $result['table_id']?>"></li>
                                   <li><h4>Message</h4></li>
                                <li><input style="width:500px"type="text"id="message"name="message"> </li>   
                               <li><h4>Description</h4></li>
                            <li><input style="width:500px"type="text"id="description"name="description"></li>
                         <li><input style="width:60px;height:40px;"class="btn btn-success"type="submit"value="Send"></li>
                        </form>                    
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
