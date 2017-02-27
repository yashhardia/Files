<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['master settings'])) echo $this->phrases['master settings'];?> &gt; <?php if(isset($title)) echo $title;?>
   </div>
   </div>
   <div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
           <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
            
            <table id="example" class="cell-border example" cellspacing="0" width="100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['subject'])) echo $this->phrases['subject'];?></th>
                     <th><?php if(isset($this->phrases['sms template'])) echo $this->phrases['sms template'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['subject'])) echo $this->phrases['subject'];?></th>
                     <th><?php if(isset($this->phrases['sms template'])) echo $this->phrases['sms template'];?></th>
                     <th><?php if(isset($this->phrases['status'])) echo $this->phrases['status'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </tfoot>
			   <?php if(isset($sms_templates) && count($sms_templates)>0) {?>
               <tbody>
                  <?php $cnt = 1; foreach($sms_templates as $l) { ?>
                  <tr>
                     <td><?php echo $cnt++;?></td>
                     <td><?php echo $l->subject;?></td>
                     <td><?php echo $l->sms_template;?></td>
                     <td><?php if($l->status=='Active') echo "<span  class='badge success'>".$this->phrases['active']."</span>"; else echo "<span  class='badge danger'>".$this->phrases['inactive']."</span>" ?> 
			   </td>
                     <td>
                        <?php 
                           
                           echo anchor(URL_SMS_TEMPLATES.DS.EDIT.DS.$l->sms_template_id,'<i class="fa fa-edit"></i>','class="btn btn-info" title="Edit"'); 
                           
                           ?> 
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
			   <?php } ?>
            </table>
         </div>
      </div>
   </div>
</div>
