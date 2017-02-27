<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_INFOTAINMENT;?>" style="text-decoration:none;"><?php if(isset($this->phrases['infotainment'])) echo $this->phrases['infotainment'];?></a>  &gt;  <?php if(isset($this->phrases['infotainment'])) echo $this->phrases['view category'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body" >
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> <?php echo $this->phrases['view category'];?></div>
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
                  <tr role="row"><th class="sorting">Parent Category</th><th class="sorting">Sub Category</th></tr>
               </thead>
         <?php foreach($parent_category as $val){echo '<tr><td>'.$val['category']?><?php ?></td><td><?php if($val['parent']==null){echo "_";}else{echo $val['parent'];}}?></td></tr>
           </table>       
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


