<div class="col-md-10 col-sm-10 paddig">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <?php if(isset($this->phrases['master settings'])) echo $this->phrases['master settings'];?> &gt; <?php if(isset($title)) echo $title;?>
   </div>
   </div>
   <div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
       <h3><?php if(isset($title)) echo $title;?></h3>
         <div class="col-md-12">
           <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
            <!--<a  href="<?php echo site_url().URL_ADD_SMS_GATEWAY; ?>" type="button" class="butto" style="text-decoration:none;"> <?php if(isset($this->phrases['add'])) echo $this->phrases['add'];?> <i class="fa fa-plus"></i></a> -->
            <table id="example" class="cell-border example" cellspacing="0" width="100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['sms gateway name'])) echo $this->phrases['sms gateway name'];?></th>
                     <th><?php if(isset($this->phrases['is default'])) echo $this->phrases['is default'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php if(isset($this->phrases['sms gateway name'])) echo $this->phrases['sms gateway name'];?></th>
                     <th><?php if(isset($this->phrases['is default'])) echo $this->phrases['is default'];?></th>
                     <th><?php if(isset($this->phrases['action'])) echo $this->phrases['action'];?></th>
                  </tr>
               </tfoot>
			   <?php if(isset($sms_gateways) && count($sms_gateways)>0) {?>
               <tbody>
                  <?php $cnt = 1; foreach($sms_gateways as $l) { ?>
                  <tr>
                     <td><?php echo $cnt++;?></td>
                     <td><?php echo $l->sms_gateway_name;?></td>
                     <td><?php echo $l->is_default;?></td>
                     <td>
                        <?php 
                           
                           /*echo anchor(URL_ADD_SMS_FIELDS.DS.$l->sms_gateway_id,'<i class="fa fa-plus"></i>','class="btn btn-success" title="Add"'); */
                           echo anchor(URL_UPDATE_SMS_FIELD_VALUES.DS.$l->sms_gateway_id,'<i class="fa fa-edit"></i>','class="btn btn-info" title="Edit"'); 
                           echo anchor(URL_MAKE_DEFAULT.DS.$l->sms_gateway_id,'<i class="fa fa-hand-o-right"></i>','class="btn btn-success" title="Make Default"'); 
                           
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
