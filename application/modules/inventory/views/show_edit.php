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
                            <form action="<?php echo base_url()?>inventory/show_edit/<?php echo $result[0]['item_id']?>"method="post"accept-charset="utf-8">
                                <li><h4></h4></li>
                                <li><h4>Item Id</h4></li>
                                <li><input style="width:500px"type="text"id="item_id"name="item_id"value="<?php echo $result[0]['item_id'];?>"readonly></li>
                                <li><h4></h4></li>
                                <li><h4>Item</h4></li>
                                <li><input style="width:500px"type="text"id="item_name"name="item_name"value="<?php echo $result[0]['item_name']?>"readonly></li>
                               <li><h4>Stock</h4></li>
                                <li><input style="width:500px"type="text"id="stock"name="stock"value=""></li>
                            <li>Backorder<input style="width:50px"type="checkbox"id="backorder"name="backorder"></li>
                         <li><input style="width:60px;height:40px;"class="btn btn-success"type="submit"value="Send"></li>
                        
                        </form>                    
                            </div>              
                            </div>
                         </div>
                       </div>                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="<?php echo base_url()?>assets/js/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#button").click(function(){
        var item_id = $('#item_id').val();
        var item_name = $('#item_name').val();
        var stock = $('#stock').val();
        var backorder = $('#backorder').val();
      $.ajax({url:"<?php echo base_url()?>inventory/set_out",data:{'item_id' : item_id,'item_name' : item_name,'stock' : stock,'backorder' : backorder},method:'post'}).done(alert("Succefully Added"));window.location="<?php echo base_url();?>inventory"
    });
});
</script>
