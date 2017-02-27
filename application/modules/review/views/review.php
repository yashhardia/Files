<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_REVIEW;?>" style="text-decoration:none;"><?php if(isset($this->phrases['review'])) echo $this->phrases['review'];?></a>    
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> <?php echo $this->phrases['inventory'];?></div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
                        <div class="col-sm-12"><ul class="ord">
                        
                          <div class="form-group filerSear clearfix">        
              <div class="col-lg-3 col-sm-3 col-xs-12 padding-l">
               
              </div>              
            </div>
			<!--Multi Operation-->
            <table id="example" class="cell-border example dataTable" >
               <thead>
                  <tr role="row"><th class="sorting_asc" ><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></th><th class="sorting" >Name</th><th class="sorting" >Mobile</th><th class="sorting">Email</th><th class="sorting">Table</th><th class="sorting">Order Id</th><th class="sorting">Description</th><th class="sorting">Reply</th>
               </thead>
            <?php foreach($result as $val){?>
              <tr> 
			<td><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></td>
            <td><?php echo $val['first_name'];?></td>            
            <td><?php echo $val['phone'];?></td>
            <td><?php echo $val['email'];?></td>
            <td><?php echo $val['table_id'];?></td>
            <td><?php echo $val['order_id'];?></td>
            <td><?php echo $val['description'];?></td><td><div class="digiCrud">
					<a href="<?php base_url()?>review/reply/<?php echo $val['customer_id']?>?table=<?php echo $val['table_id']?>" class="btn btn-warning">
						<i class="glyphicon glyphicon-share-alt" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div></td>
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
