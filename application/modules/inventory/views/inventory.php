<style>
.switch {
  position: relative;
  display: inline-block;
  width: 5px;
  height: 25px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #2196F3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

</style>
<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_INVENTORY;?>" style="text-decoration:none;"><?php if(isset($this->phrases['inventory'])) echo $this->phrases['inventory'];?></a>    
   </div>
</div>
<div class="col-md-10 col-sm-10 ">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> <?php echo $this->phrases['inventory'];?></div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if($message){?><div class="alert alert-success"id="infoMessage"><?php if(isset($message)) echo $message;}?></div>
                        <div class="col-sm-12"><ul class="ord">
                        
                          <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               
              </div>              
            </div>
			<!--Multi Operation-->
            <table id="example" class="cell-border example dataTable" >
               <thead>
                  <tr role="row"><th class="sorting_asc" ><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></th><th class="sorting" >Item Image</th><th class="sorting" >Item Name</th><th class="sorting">Item Cost</th><th class="sorting">Item Type</th><th class="sorting_disabled">Action</th><th class="sorting_disabled">Edit/View</th>
               </thead>
            <?php foreach($result as $val){?>
              <tr> 
			<td><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></td>
            <td><img style="height:100px;width:100px"src="<?php echo base_url().'uploads/item_images/'.$val['item_image_name'];?>"></td>
            <td><?php echo $val['item_name'];?></td>            
            <td><?php echo $val['item_cost'];?></td>
            <td><?php echo $val['item_type'];?></td>
            <td><label class="switch"style="width:50px">
                <input type="checkbox"id="check_box"name="check_box" checked>
                <div class="slider round"></div>
                </label>
            <br><br>


</label></td>
            <td><a href="<?php echo base_url();?>inventory/show_edit/<?php echo $val['item_id'];?>" class="btn btn-info">
						<i class="glyphicon glyphicon-share-alt"style="margin-left:15px" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a></td>
            </tr><?php }?>
           </table> 
                                               
                            </ul></div>
                                </div>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
  function show (toBlock){
    setDisplay(toBlock, 'block');
  }
  function hide (toNone) {
    setDisplay(toNone, 'none');
  }
  function setDisplay (target, str) {
    document.getElementById(target).style.display = str;
  }
</script>
