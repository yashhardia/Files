<section class="bottom_footer">
<div class="col-lg-6 col-md-6 pull-left">
      <div class="copyright-left">
         <p><?php if(isset($this->phrases['design by'])) echo $this->phrases['design by'];?> <?php if(isset($site_settings->design_by)) echo $site_settings->design_by;?></p>
      </div>
   </div>
   <div class="col-lg-6 col-md-6 pull-right">
      <div class="copyright-right">
         <p><?php if(isset($site_settings->rights_reserved_content)) echo $site_settings->rights_reserved_content;?></p>
      </div>
   </div>
</section>
</div>
<!-- Body --> 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!-- formscript start -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/BeatPicker.min.js"></script> 
<link href="<?php echo base_url(); ?>assets/css/uniform.default.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>assets/css/chosen.min.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>assets/js/jquery.uniform.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>assets/css/alertifyjs/themes/alertify.core.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/alertifyjs/themes/alertify.default.css" id="toggleCSS" />
<script src="<?php echo base_url();?>assets/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/form-validation.js"></script>

<!-- Formscript END -->
<!--Data Tables Start -->
<script type="text/javascript"  src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script> 
<!--<script type="text/javascript"  class="init">
   /*$(document).ready(function() {
   	$('#example').dataTable();
   	$('.example').dataTable();
   });*/
   // window.history.foward(-1);   	
</script> -->
<!-- Data tables -->
<script type="text/javascript" language="javascript" class="init">
var datatablevar;
$(document).ready(function() {
	
	<?php
	
	if(isset($ajaxrequest)) { ?>
	
	datatablevar = $('#example').dataTable(	
	{
        <?php if(isset($ajaxrequest['disablesorting'])) {?>
		"aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ <?php echo $ajaxrequest['disablesorting'];?> ] }
		],
		<?php } ?>
		/*<?php if(isset($ajaxrequest['language'])) {?>
			"language": {				
				<?php if(isset($ajaxrequest['language']['infoEmpty'])) {?>
				"infoEmpty": "No records available test",
				<?php } ?>
			},
		<?php } ?>*/
		<?php if(isset($ajaxrequest['url'])) {?>
		
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "<?php echo $ajaxrequest['url'];?>",
			"type": "POST",
			"data": function ( d ) {
				d.<?php echo $this->security->get_csrf_token_name(); ?>="<?php echo $this->security->get_csrf_hash(); ?>";
				
				<?php if(isset($ajaxrequest['type']) && $ajaxrequest['type'] != '') {?>
					d.type = "<?php echo $ajaxrequest['type'];?>";
				<?php } else {?>
					d.type = "Category";
				<?php } ?>
				<?php if(isset($ajaxrequest['params']) && count($ajaxrequest['params']) > 0) 
				{
					foreach($ajaxrequest['params'] as $pakey => $paval)
					{ ?>
						d.<?php echo $pakey;?> = "<?php echo $paval;?>";
					<?php } ?>								
				<?php } ?>
			}
		},
		<?php } ?>
    }
	
	);
	<?php }else{ ?>
	$('.example').dataTable();
	<?php } ?>
	
} );

function showhide()
{
	var val = $('#field_type').val();
	if(val == 'select')
	{
		$('#selectlist').show();
	}
	else
	{
		$('#selectlist').hide();
	}
}
showhide();
</script>

<script src="<?php echo base_url(); ?>assets/js/functions.js"></script> 

<!--Data Tables End -->
<script>
   jQuery(document).ready(function() {  FormValidation.init();
   		});
    		$(function() {
   		 
   			$(".uniform_on").uniform();
   			$(".chzn-select").chosen();
   		 
    
   		});
	$("input[type='reset'], button[type='reset']").click(function(e){
   
       $('form').find('select').each(function(i, v) {
			 
       $(".chzn-select").val('').trigger("liszt:updated");
	   $('#language').val(<?php echo $site_settings->language_id; ?>).trigger("liszt:updated");
    });
  });        
</script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/sidemenu-script.js"></script>

<?php $site_settings = $this->db->get(DBPREFIX.TBL_SITE_SETTINGS)->result() [0];?>
<!--./footer-->
<!--./bottom_footer-->
</body>
</html>