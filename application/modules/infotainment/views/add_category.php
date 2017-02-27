
<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt;<?php if(isset($this->phrases['add category'])) echo $this->phrases['add category'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10 ">
   <div class="admin-body">
   <!--<div>data-spy="affix" data-offset-top="50"</div>-->
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> Add Category</div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"></div>
                     <ul class="ord">
                       <form action="http://localhost/Files/infotainment/add_category" name="add_category" id="add_category" method="post" accept-charset="utf-8" novalidate="novalidate">
<input type="hidden" name="csrf_digi_name" value="921a369818d6544089653114dc0032e6" style="display:none;">
                       
                        
                        <div class="form-group">
                           <label>Category Name<span style="color:red;">*</span></label>
                           <input type="text" name="category_name"id="category_name" value="">
                                                   </div>
                        <div class="form-group">
                           <label>Parent Category</label>
                           <select name="parent_category">
                            <option>Select Category</option>
                           <?php foreach($data as $val){?>
                              <option value="<?php echo $val['category_id'];?>"><?php echo $val['category_name'];}?></option> 
                           </select>
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

<script>
function validate() {
    var category = document.add_category.category_name.value;
    if(category==0)
    {alert('Please Select Mandetory Fields');}

    else {alert('Category Added Succesfully');}}
</script>

 

