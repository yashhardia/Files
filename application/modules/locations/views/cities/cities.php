<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['location master'])) echo $this->phrases['location master'];?> &gt; <?php if(isset($title)) echo $title;?> 
   </div>
</div>
   <div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
		<h3><?php if(isset($title)) echo $title;?></h3>
         <div class="col-md-12">
           <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
            <?php $attributes = array('name'=>'tokenform','id'=>'tokenform');
		echo form_open('',$attributes) ?>
            <a href="<?php echo base_url().CITIES_ADD;?>" type="button" class="butto add" title="Add City"> <?php if(isset($this->phrases['add'])) echo $this->phrases['add'];?>  <i class="fa fa-plus"></i></a> 
			
            <a href="<?php echo base_url();?>locations/cities/cities" type="button" class="butto pull-right add"><?php if(isset($this->phrases['upload excel'])) echo $this->phrases['upload excel'];?> </a> 
            <!--Multi Operation-->
            <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               <select name="multioperation" id="multioperation" onchange="javascript:multioperationfunction(this.value, '<?php echo CITIES_DELETE;?>', '<?php echo CITIES_STATUSTOGGLE;?>')">
               <option selected="" disabled="" value=""><?php if(isset($this->phrases['select']))echo $this->phrases['select'];?></option>
				
				<option value="Active"><?php if(isset($this->phrases['activate']))echo $this->phrases['activate'];?></option>
				<option value="Inactive"><?php if(isset($this->phrases['de activate']))echo $this->phrases['de activate'];?></option>               
              </select>
              </div>              
            </div>
			<!--Multi Operation-->
            <table id="example" class="cell-border example" cellspacing="0" width="100%">
               <thead>
                  <tr>
                     <th><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></th>
                     <th><?php if(isset($this->phrases['city name'])) echo $this->phrases['city name'];?>  </th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?> </th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?> </th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['city name'])) echo $this->phrases['city name'];?>  </th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?> </th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?> </th>
                 </tr>
               </tfoot>
              
            </table>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
            <span class="sr-only"><?php if(isset($this->phrases['close'])) echo $this->phrases['close'];?></span></button>            
            <h4 class="modal-title" id="myModalLabel"><?php if(isset($this->phrases['delete'])) echo $this->phrases['delete'];?></h4>
         </div>
         <div class="modal-body"><?php if(isset($this->phrases['are you sure to delete'])) echo $this->phrases['are you sure to delete'];?>?</div>
         <div class="modal-footer">            
            <a  class="btn btn-success" id="delete_city" href="">
            <?php if(isset($this->phrases['yes'])) echo $this->phrases['yes'];?>  </a> 
            <button type="button" class="btn btn-danger" data-dismiss="modal">
            <?php if(isset($this->phrases['no'])) echo $this->phrases['no'];?> </button>         
         </div>
      </div>
   </div>
</div>
<script>   
   function changeDeleteId(x) {
   	
   	
   var str = "<?php echo base_url(); ?>locations/cities/Delete/" + x;    
	$("#delete_city").attr("href",str);  
   }
   
</script>
