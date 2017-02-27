<div class="col-md-10 paddig col-sm-10 ">
   <div class="brade">
      <a href="<?php echo base_url();?>admin" style="text-decoration:none;"><?php if(isset($this->phrases['home'])) echo $this->phrases['home'];?></a> 
      &gt; <a href="<?php echo base_url().URL_CONFIGURATIONS;?>" style="text-decoration:none;"><?php if(isset($this->phrases['configurations'])) echo $this->phrases['configurations'];?></a>  &gt;  <?php if(isset($this->phrases['configurations details'])) echo $this->phrases['configurations details'];?>
   </div>
</div>
<div class="col-md-10 col-sm-10">
   <div class="admin-body">
      <div class="inner-elements">
         <div class="col-md-12">
            <div class="panel">
               <div class="panel-heading ele-hea"> <?php echo $this->phrases['configurations'];?></div>
               <div class="panel-body">
                  <div class="inner-pages-forms">
                     <div id="infoMessage"></div>
                     <ul class="ord">
                        <form>
                        <table>
                        </table>
                        </form>                    
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
