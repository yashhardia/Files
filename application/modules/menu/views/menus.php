<div class="col-md-10 col-sm-10 paddig"overflow-y: scroll;>
   <div class="brade"overflow-y: scroll;>
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['menu'])) echo $this->phrases['menu'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10"overflow-y: scroll;>
   <div class="admin-body"overflow-y: scroll;>
      <div class="inner-elements">
	    <h3><?php if(isset($title)) echo $title;?></h3>
         <div class="col-md-12">
            <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
			 <?php $attributes = array('name'=>'tokenform','id'=>'tokenform');
		echo form_open('',$attributes) ?>
            <a  href="<?php echo site_url().URL_ADD_MENU; ?>" type="button" class="butto" style="text-decoration:none;"> <?php if(isset($this->phrases['add'])) echo $this->phrases['add'];?> <i class="fa fa-plus"></i></a> 
            <!--Multi Operation-->
            <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               <select name="multioperation" id="multioperation" onchange="javascript:multioperationfunction(this.value, '<?php echo URL_DELETE_MENU;?>', '<?php echo URL_MENU_STATUSTOGGLE;?>')">
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
                     <th><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')">
                        </th>
                     <th><?php if(isset($this->phrases['menu name'])) echo $this->phrases['menu name'];?></th>
                     <th><?php if(isset($this->phrases['punch line'])) echo $this->phrases['punch line'];?></th>
                     <th><?php if(isset($this->phrases['description'])) echo $this->phrases['description'];?></th>
                     <th><?php if(isset($this->phrases['menu image'])) echo $this->phrases['menu image'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                      <th><?php if(isset($this->phrases['menu name'])) echo $this->phrases['menu name'];?></th>
                     <th><?php if(isset($this->phrases['punch line'])) echo $this->phrases['punch line'];?></th>
                     <th><?php if(isset($this->phrases['description'])) echo $this->phrases['description'];?></th>
                     <th><?php if(isset($this->phrases['menu image'])) echo $this->phrases['menu image'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </tfoot>
		 </table>
		 <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal">
   <div class="modal-dialog">
   <?php $attributes = array('name'=>'menu_delete','id'=>'menu_delete');
		echo form_open(URL_DELETE_MENU,$attributes); ?>
      <div class="modal-content">
             
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
            <span class="sr-only"><?php if(isset($this->phrases['close'])) echo $this->phrases['close'];?></span></button>            
            <h4 class="modal-title" id="myModalLabel"><?php if(isset($this->phrases['delete'])) echo $this->phrases['delete'];?></h4>
         </div>
         <div class="modal-body">  <?php if(isset($this->phrases['are you sure to delete'])) echo $this->phrases['are you sure to delete'];?>?    </div>
         <input type="hidden" id="menu_id" name="menu_id" value="0">   
         <div class="modal-footer">            
            <button type="submit" class="btn btn-success"><?php if(isset($this->phrases['yes'])) echo $this->phrases['yes'];?></button>  
            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php if(isset($this->phrases['no'])) echo $this->phrases['no'];?></button>         
         </div>
         
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
<script>   
   function changeDeleteId(x) {   	
   $('#menu_id').val(x);
   }
</script>
