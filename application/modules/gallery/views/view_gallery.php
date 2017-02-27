<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['gallery'])) echo $this->phrases['gallery'];?> 
   </div>
</div>
<div class="col-md-10 col-sm-10 ">
   <div class="admin-body">
      <div class="inner-elements">
		 <h3><?php if(isset($title)) echo $title;?></h3>
         <div class="col-md-12">
            <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
             <?php $attributes = array('name'=>'tokenform','id'=>'tokenform');
		echo form_open('',$attributes) ?>
            <a  href="<?php echo site_url().URL_ADD_GALLERY;?>" type="button" class="butto" style="text-decoration:none;"> <?php if(isset($this->phrases['add'])) echo $this->phrases['add'];?> <i class="fa fa-plus"></i></a>   
             <!--Multi Operation-->
            <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               <select name="multioperation" id="multioperation" onchange="javascript:multioperationfunction(this.value, '<?php echo URL_DELETE_GALLERY;?>', '<?php echo URL_GALLERY_STATUSTOGGLE;?>')">
            
				<option selected="" disabled="" value=""><?php if(isset($this->phrases['select']))echo $this->phrases['select'];?></option>
				<option value="delete"><?php if(isset($this->phrases['delete']))echo $this->phrases['delete'];?></option>
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
                     <th><?php if(isset($this->phrases['image'])) echo $this->phrases['image'];?></th>
                     <th><?php if(isset($this->phrases['alt text'])) echo $this->phrases['alt text'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['image'])) echo $this->phrases['image'];?></th>
                     <th><?php if(isset($this->phrases['alt text'])) echo $this->phrases['alt text'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </tfoot>
              
            </table>
         </div>
      </div>
   </div>
</div> 
