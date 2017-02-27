<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url().URL_ADMIN;?>" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['notifications'])) echo $this->phrases['notifications'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10 ">
   <div class="admin-body">
      <div class="inner-elements">
	    <h3><?php if(isset($title)) echo $title;?></h3>
         <div class="col-md-12">
            <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
			
            <a  href="<?php echo site_url().URL_NEW_NOTIFICATIONS; ?>" type="button" class="butto" style="text-decoration:none;"> <?php if(isset($this->phrases['add'])) echo $this->phrases['add'];?> <i class="fa fa-plus"></i></a> 
            <table id="example" class="cell-border example" cellspacing="0" width="100%">
               <thead>
                  <tr>
                     <th>#</th>
                    
                     <th><?php if(isset($this->phrases['message'])) echo $this->phrases['message'];?></th>
                     <th><?php if(isset($this->phrases['no of success'])) echo $this->phrases['no of success'];?></th>
                     <th><?php if(isset($this->phrases['no of failures'])) echo $this->phrases['no of failures'];?></th>
                    
                     <th><?php if(isset($this->phrases['created on'])) echo $this->phrases['created on'];?></th>                     
                     <th><?php if(isset($this->phrases['last sent'])) echo $this->phrases['last sent'];?></th>                   
                    
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                   
                     <th><?php if(isset($this->phrases['message'])) echo $this->phrases['message'];?></th>
                     <th><?php if(isset($this->phrases['no of success'])) echo $this->phrases['no of success'];?></th>
                     <th><?php if(isset($this->phrases['no of failures'])) echo $this->phrases['no of failures'];?></th>
                    
                     <th><?php if(isset($this->phrases['created on'])) echo $this->phrases['created on'];?></th>                     
                     <th><?php if(isset($this->phrases['last sent'])) echo $this->phrases['last sent'];?></th>
                   
                  </tr>
               </tfoot>
               <tbody>
                  <?php 						
                     $i=1;
                     foreach($notifications as $notification):
                     
                     ?>
                  <tr>
                     <td><?php echo $i; $i++; ?></td>
                     
                     <td><?php echo $notification['message']; ?></td>
                     <td><?php echo $notification['successful']; ?></td>
                     <td><?php echo $notification['failed']; ?></td>
                                        
                     <td><?php echo date("D M j G:i:s T Y",$notification['queued_at']); ?></td>
                     <td><?php echo date("D M j G:i:s T Y",$notification['send_after']); ?></td>
                                          
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
