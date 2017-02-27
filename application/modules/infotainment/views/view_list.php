

<div class="col-md-10 paddig col-sm-10">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
       &gt;  <?php if(isset($this->phrases['infotainment'])) echo $this->phrases['view list'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> <?php echo $this->phrases['view list'];?></div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
                     <ul class="ord">
                       <a href="http://localhost/Files/infotainment/add_media" type="button" class="butto" style="text-decoration:none;"> Add <i class="fa fa-plus"></i></a> 
             <!--Multi Operation-->
            <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               
              </div>              
            </div>
			<!--Multi Operation-->
            <table id="example" class="cell-border example dataTable" >
               <thead>
                  <tr role="row"><th class="sorting_asc" ><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></th><th class="sorting" >Media Name</th><th class="sorting">Media</th><th class="sorting">Category</th><th class="sorting_disabled">Sub Category</th><th class="sorting">Description</th></tr>
               </thead>
            <?php foreach($data as $val){?>
              <tr> 
			<td><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></td>
            <td><img style="height:100px;width:100px"src="<?php echo base_url().'uploads/media/'.$val['file_name'];?>"></td>
            <td><?php echo $val['media_name'];?></td>            
            <td><?php echo $val['category_name'];?></td>
            <td><?php echo $val['sub_category'];?></td>
            <td><?php echo $val['description'];?></td>
            </tr><?php }?>
           </table       
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--	Validations	-->
   
   <script>
function validate() {
    var category = document.add_media.parent_category.value;
    var userfile = document.add_media.userfile.value;
    if(category==0||userfile==0)
    {alert('Please Select Mandetory Fields');}
else {alert('Media Added Succesfully');}}
</script>


