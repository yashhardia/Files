

<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt;  <?php if(isset($this->phrases['infotainment'])) echo $this->phrases['add media'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10 ">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> Send Mail</div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
                     <ul class="ord">
                       <form action="http://localhost/Files/infotainment/add_media" name="add_media" id="add_media" method="post" accept-charset="utf-8" novalidate="novalidate"enctype="multipart/form-data">
<input type="hidden" name="csrf_digi_name" value="921a369818d6544089653114dc0032e6" style="display:none;">
                       
                        
                        
                           <label>Media Name<span style="color:red;">  *</span></label>
                              <input type="text"name="media_name">
                           <label>Media Categary<span style="color:red;">  *</span></label>
        <select name="parent_category"id='parent_category' >
           <option value='0'>Select Category</option>
              <?php foreach($data as $val){?>
                <option value='<?php echo $val['category_id']?>'><?php echo $val['category_name'];}?></option> 
        </select>
                      <div id="div1"name="div1">
                           <label>Media Sub Catogary</label>
                                <select name="sub_category"id='sub_category' >
                                    <option value='0'>Select Sub Category</span></option>
                                        <?php foreach($sub_category as $val1){?>
                                    <option value='<?php echo $val1['category_id'];?>'><?php echo $val1['category_name'];}?></option> 
                                </select>
                      </div>
                            <label>Description<span style="color:red;">  *</span></label>
                                <input type="text"name="description">
                                 <div>
                                <input style="margin-top:30px"type="file"value="Select File"id="userfile"name="userfile">
                                </div>
                                 <div class="buttos">
                            <input type="submit" name="add" value="Add" class="butto"onclick="validate()">
                                </div>
                        </form>         
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--	Validations	-->
   
   <script >
function validate() {
    var category = document.add_media.parent_category.value;
    var userfile = document.add_media.userfile.value;
    if(category==0||userfile==0)
    {alert('Please Select Mandetory Fields');}
    else {alert('Media Added Succesfully');}}
  
</script>
<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
<script>
 $(document).ready(function(){
$("#div1").hide();
    $("#parent_category").change(function(){
    var parent = $('#parent_category').val();
    if(parent!=0){
        $("#div1").show();}else {$("#div1").hide()}
    });
});
</script>


