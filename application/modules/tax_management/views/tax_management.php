
<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_CUSTOMERS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['tax management'])) echo $this->phrases['tax management'];?></a>
   </div>
</div>
<div class="col-md-10 col-sm-10 ">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> Tax Management</div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if($message){?><div class="alert alert-danger">
                                            <strong><?php echo $message?></strong>
                                            </div>
                     </div><?php }?>
                     <ul class="ord">
                       <form action="http://localhost/Files/tax_management" name="tax_management" id="tax_management" method="post" accept-charset="utf-8" novalidate="novalidate">
<input type="hidden" name="csrf_digi_name" value="921a369818d6544089653114dc0032e6" style="display:none;">
                       
                        
                        <div class="form-group">
                           <label>Sequence<span style="color:red;">*</span></label>
                           <input type="text" name="sequence"id="sequence" value="">
                        
                                                   </div>
                           <div class="form-group">
                           <label>Name<span style="color:red;">*</span></label>
                           <input type="text" name="name"id="name" value="">
                        
                                                   </div>
                            <div class="form-group">
                           <label>Percent<span style="color:red;">*</span></label>
                           <input type="text" name="percent"id="percent" value="">
                        
                                                   </div>
                            <div class="form-group">
                           <label>Description<span style="color:red;">*</span></label>
                           <input type="text" name="description"id="description" value="">
                        
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

<script>
function validate() {
    var category = document.add_category.category_name.value;
    if(category==0)
    {alert('Please Select Mandetory Fields');}

    else {alert('Category Added Succesfully');}}
</script>

 

