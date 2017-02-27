<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($title)) echo ucfirst($title);?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
	  <h3><?php if(isset($title)) echo $title;?></h3>
         <div class="col-md-12 col-sm-12">
            <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
            <table id="example" class="cell-border example" cellspacing="0" width="100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['order no'])) echo $this->phrases['order no'];?></th>
                     <th><?php if(isset($this->phrases['order date'])) echo $this->phrases['order date'];?></th>
                     <th><?php if(isset($this->phrases['order time'])) echo $this->phrases['order time'];?></th>
                     <th><?php if(isset($this->phrases['order cost'])) echo $this->phrases['order cost'];?></th>
                     <th><?php if(isset($this->phrases['customer name'])) echo $this->phrases['customer name'];?></th>
                     <th><?php if(isset($this->phrases['phone'])) echo $this->phrases['phone'];?></th>
                     
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['order no'])) echo $this->phrases['order no'];?></th>
                     <th><?php if(isset($this->phrases['order date'])) echo $this->phrases['order date'];?></th>
                     <th><?php if(isset($this->phrases['order time'])) echo $this->phrases['order time'];?></th>
                     <th><?php if(isset($this->phrases['order cost'])) echo $this->phrases['order cost'];?></th>
                     <th><?php if(isset($this->phrases['customer name'])) echo $this->phrases['customer name'];?></th>
                     <th><?php if(isset($this->phrases['phone'])) echo $this->phrases['phone'];?></th>
                     
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </tfoot>
               
            </table>
         </div>
      </div>
   </div>
</div>
