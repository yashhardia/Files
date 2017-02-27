<script src="<?php echo base_url();?>assets/js/rate.js"></script><div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_RATINGS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['rating'])) echo $this->phrases['rating'];?></a>    
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> <?php echo $this->phrases['restaurant rating'];?></div>
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
                  <tr role="row"><th class="sorting_asc" ><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></th><th class="sorting" >User</th><th class="sorting">Description</th><th class="sorting">Rating</th>
               </thead>
            <?php foreach($result as $val){?>
              <tr> 
			<td><input id="checkbox-1" class="checkbox-custom selectall" name="checkbox-1" type="checkbox" onclick="selectall(this,'checkbox_class')"></td>
            <td><?php echo $val['first_name'];?></td>            
            <td><?php echo $val['description'];?></td>
            <td><script>rate(<?php echo $val['rating']?>);</script><?php echo "(".$val['rating'].")"?></td>
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
