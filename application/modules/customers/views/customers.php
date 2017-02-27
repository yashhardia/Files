<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['customers'])) echo $this->phrases['customers'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
<div class="admin-body">
<div class="inner-elements">
 <h3><?php if(isset($title)) echo $title;?></h3>
   <div class="col-md-12">
   <?php $attributes = array('name'=>'tokenform','id'=>'tokenform');
		echo form_open('',$attributes) ?>
		<div class="flash_msg col-lg-9" <?php echo (empty($message)) ? 'style="display:none;"' : 'style="display:block;"'; ?>><?php echo $message;?></div>
      <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
       <!--Multi Operation-->
            <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               <select name="multioperation" id="multioperation" onchange="javascript:multioperationfunction(this.value, '<?php echo URL_CUSTOMER_DELETE;?>', '<?php echo URL_CUSTOMER_STATUSTOGGLE;?>')">
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
               <th><?php if(isset($this->phrases['customer name'])) echo $this->phrases['customer name'];?></th>
			   <th><?php if(isset($this->phrases['email'])) echo $this->phrases['email'];?></th>
               <th><?php if(isset($this->phrases['phone'])) echo $this->phrases['phone'];?></th>
               <th><?php if(isset($this->phrases['email'])) echo $this->phrases['email'];?></th>
               <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>            
               <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>#</th>
               <th><?php if(isset($this->phrases['customer name'])) echo $this->phrases['customer name'];?></th>
               <th><?php if(isset($this->phrases['email'])) echo $this->phrases['email'];?></th>
               <th><?php if(isset($this->phrases['phone'])) echo $this->phrases['phone'];?></th>
               <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>             
               <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
            </tr>
         </tfoot>
         
      </table>
   < </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
            
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
            <span class="sr-only"><?php if(isset($this->phrases['close'])) echo $this->phrases['close'];?></span></button>            
            <h4 class="modal-title" id="myModalLabel"><?php if(isset($this->phrases['delete'])) echo $this->phrases['delete'];?></h4>
         </div>
         <div class="modal-body">  <?php if(isset($this->phrases['are you sure to delete'])) echo $this->phrases['are you sure to delete'];?>?    </div>
         <input type="hidden" id="menu_id" name="menu_id" value="0">   
         <input type="hidden" name="deleting_record_id" id="deleting_record_id" value="">
	  <input type="hidden" name="deleting_record_id_url" id="deleting_record_id_url" value="">    
         <div class="modal-footer">            
            <button type="button"  onclick="delete_record_final()" class="btn btn-success"><?php if(isset($this->phrases['yes'])) echo $this->phrases['yes'];?></button>  
            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php if(isset($this->phrases['no'])) echo $this->phrases['no'];?></button>         
         </div>
         
      </div>
   </div>
</div>
<script>   
   function changeDeleteId(x) {   	
   $('#menu_id').val(x);
   }
</script>
 
