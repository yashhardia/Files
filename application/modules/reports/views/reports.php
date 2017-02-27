
<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt;<a href="<?php echo base_url().URL_REPORT;?>" style="text-decoration:none;"><?php if(isset($this->phrases['reports'])) echo $this->phrases['reports'];?></a>
   </div>
</div>
<div class="col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"></div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if($message){echo "<div class='alert alert-warning'>".$message."</div>";}?></div>
                     <ul class="ord">
                       <form name="add_category" id="add_category" method="post" accept-charset="utf-8" novalidate="novalidate">                     
                        <div class="col-md-8">
                        <div class="form-group">
                           <label>Parent Category<span style="color:red">  *</span></label>
                           <select name="parent_category"id="parent_category">
                            <option value='0'>Select Category</option>
                           <?php foreach($data as $val){?>
                              <option value="<?php echo $val['category_id'];?>"><?php echo $val['category_name'];}?></option> 
                           </select><div id="div1">
                            <label>Sub Category<span style="color:red">  *</span></label>
                           <select name="sub_category">
                            <option value='0'>Select Category</option>
                           <?php foreach($sub_category as $val){?>
                              <option value="<?php echo $val['category_id'];?>"><?php echo $val['category_name'];}?></option> 
                           </select></div>
                        <div class="buttos">
                           <button id='btn1' name='btn1'type="submit"class="btn btn-info">Download</button>
                           
                        </div></div>
                        </form>                   
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
<script>
 $(document).ready(function(){
$("#div1").hide();
    $("#parent_category").click(function(){
    var parent = $('#parent_category').val();
    if(parent!=0){
        $("#div1").show();}else {
        $("#div1").hide()}
    });
});
    $(document).ready(function(){
$("#div1").hide();
    $("#btn1").click(function(){
    $.ajax({url:"<?php echo base_url()?>reports/show_report",data:{},type:"post"}).done(function() {
});
    });
});
</script>

 

