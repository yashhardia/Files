<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['items'])) echo $this->phrases['items'];?>
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
            <a  href="<?php echo site_url().URL_ADD_ITEMS?>" type="button" class="butto" style="text-decoration:none;"> <?php if(isset($this->phrases['add'])) echo $this->phrases['add'];?> <i class="fa fa-plus"></i></a> 
             <!--Multi Operation-->
            <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               <select name="multioperation" id="multioperation" onchange="javascript:multioperationfunction(this.value, '<?php echo URL_DELETE_ITEMS;?>', '<?php echo URL_ITEM_STATUSTOGGLE;?>')">
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
                     <th>#</th>
                     <th><?php if(isset($this->phrases['menu name'])) echo $this->phrases['menu name'];?></th>
                     <th><?php if(isset($this->phrases['item name'])) echo $this->phrases['item name'];?></th>
                     <th><?php if(isset($this->phrases['item cost'])) echo $this->phrases['item cost'];?></th>
					 <th><?php if(isset($this->phrases['item type'])) echo $this->phrases['item type'];?></th>
                     <th><?php if(isset($this->phrases['description'])) echo $this->phrases['description'];?></th>
                     <th><?php if(isset($this->phrases['item image'])) echo $this->phrases['item image'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['menu name'])) echo $this->phrases['menu name'];?></th>
                     <th><?php if(isset($this->phrases['item name'])) echo $this->phrases['item name'];?></th>
                     <th><?php if(isset($this->phrases['item cost'])) echo $this->phrases['item cost'];?></th>
                     <th><?php if(isset($this->phrases['item type'])) echo $this->phrases['item type'];?></th>
                     <th><?php if(isset($this->phrases['description'])) echo $this->phrases['description'];?></th>
                     <th><?php if(isset($this->phrases['item image'])) echo $this->phrases['item image'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </tfoot>
              
            </table>
         </div>
      </div>
   </div>
</div>
