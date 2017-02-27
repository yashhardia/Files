<div class="col-md-10 col-sm-10 paddig ">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_CONCERNS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['raise concern'])) echo $this->phrases['raise concern'];?></a>  
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"></div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if(isset($message)) echo "<p class='alert alert-danger'>".$message."</p>";?></div>
                     <ul class="ord">
                        <form action="<?php echo base_url().URL_CONCERNS?>"method="post"name="form_concern"id="form_concern">
                         <ul>
                           <li><input style="width:500px"type="text"placeholder="Name"name="name"><span style="color:red;">  *</span></li>
                           <li><input style="width:500px"type="text"placeholder="Mobile Number"name="mobile"><span style="color:red;">  *</span></li>
                           <li><input style="width:500px"type="text"placeholder="Email"name="email"><span style="color:red;">  *</span></li>
                           <li><input style="width:500px"type="text"placeholder="Subject"name="subject"><span style="color:red;">  *</span></li>
                           <li><textarea style="width:500px"type="text"placeholder="Concern"name="concern"></textarea><span style="color:red;">  *</span></li>
                           <li><input type="submit"style="margin-left:440px;height:40px;width:60px"value="Send"class="btn btn-success"></li>
                         </ul>
                        </form>                    
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--<script type="text/javascript">
var name = document.form_concern.name.value;
var mobile = document.form_concern.mobile.value;
var email = document.form_concern.email.value;
var subject = document.form_concern.subject.value;
if(name!='0'&&mobile!='0'&&email!='0'&&subject!='0'){
alert("Please Fill Manditory Details");}
else{alert("Concern Added Succefully");}
</script>-->
