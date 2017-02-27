<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_PROMOTION;?>" style="text-decoration:none;"><?php if(isset($this->phrases['promotion'])) echo $this->phrases['promotion'];?></a>    
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> <?php echo $this->phrases['promotion'];?></div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if($message){?><div class="alert alert-success">
                                            <strong><?php echo $message?></strong>
                                            </div>
                     </div><?php }?>
                        <div class="col-sm-7"> 
                           <form name="form_promotion"id="form_promotion"action="<?php echo base_url();?>promotion/request_promotion"method="post"> 
                            <table>
                            <tr>
                            <div class="col-sm-5">    
                            <select id="package"name="package"><option value="0">Choose Package</option><option value="1">Select</option></select>                    
			                </div> <span style="color:red">*</span>
                            <div class="col-sm-5"id="sub_category"> 
                            <select id="select_sub_package"name="select_sub_package"><option>Promotion Description</option><option></option></select>
                            </tr></div>
                            <tr></tr><tr><div class="col-sm-10"><textarea style="margin-top:50px;height:200px;"placeholder="Description"name="description"></textarea>
                            </div></tr>
                            <tr></tr><tr><div class="col-sm-5"style="margin-top:30px;">
                            <input type="submit"value="Request"class="btn btn-success"></div></tr>
                           </table></form>
			            </div>
                        <div class="col-sm-5"id="div2"> 
                            <table ><tr><p>Promotion Description</p>
                            <div class="col-sm-10">    
                           <div class="col-sm-5">Start Date</div> <div class="col-sm-7"><input type="text"placeholder="Start Date"></tr>
                            </div>
                            <div class="col-sm-10">    
                           <div class="col-sm-5">End Date</div> <div class="col-sm-7"><input type="text"placeholder="End Date"></tr></div>
                            <tr></tr><tr><div class="col-sm-10"><textarea style="margin-top:50px;height:100px;"placeholder="Summary"></textarea></div></tr>
                           </table>                    
			            </div>
                        </div>
                     </div>                   
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
  function show (toBlock){
    setDisplay(toBlock, 'block');
  }
  function hide (toNone) {
    setDisplay(toNone, 'none');
  }
  function setDisplay (target, str) {
    document.getElementById(target).style.display = str;
  }
</script>
<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
<script>
 $(document).ready(function(){
$("#sub_category").hide();
$("#div2").hide();
    $("#package").click(function(){
    var parent = $('#package').val();
    if(parent!=0){
        $("#sub_category").show();}else {$("#sub_category").hide()}
    });
$("#select_sub_package").click(function(){
    var parent = $('#select_sub_package').val();
    if(parent!=0){
        $("#div2").show();}else {$("#div2").hide()}
    });
});
</script>

