<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
<link href="<?php echo base_url('assets/css/jquery-ui.css') ?>" rel="stylesheet">
<form class="form-horizontal form-addProblem" action="<?php echo base_url('admin/updateUser');?>" method="POST">
<div class="medication_section">
	<input class="input-xlarge"  type="hidden" name="medication[medicationId]" value="<?php echo (($medicationId != '')?$medicationDetails->getMedicationId():''); ?>" />
	<div class="control-group">
     <label class="control-label">Search Medication</label>
     <div class="controls">
        <input class="input-xlarge" type="text" data-divId=".matched_medications" data-destId="#medicationId" placeholder="Please enter the search here" name="term" id="matched_medications_input" value="" />
        <ul class="matched_medications">

        </ul>	
        <div class="help-block">
        </div>
     </div>
</div>

<div class="control-group">
     <label class="control-label">Concept Id</label>
     <div class="controls">
        <input class="input-xlarge" type="text" id="medicationId" name="medication[conceptId]" value="<?php echo (($medicationId != '')?$medicationDetails->getConceptId():''); ?>" />
        <span><?php echo (($medicationId != '')?$medicationDetails->getConceptObject()->getTerm():''); ?></span>
        <div class="help-block">
        </div>
     </div>
</div>

<div class="control-group">
	     <label class="control-label">Notes on Problem</label>
	     <div class="controls">
	        <input class="input-xlarge" type="text" name="medication[notes]" value="<?php echo (($medicationId != '')?$medicationDetails->getNotes():''); ?>" />
	        <div class="help-block">
	        </div>
	     </div>
	</div>

	<div class="control-group">
	     <label class="control-label">Start Date</label>
	     <div class="controls">
	        <input class="input-xlarge" type="text" id="startDate" name="medication[startDate]" value="<?php echo (($medicationId != '')?$medicationDetails->getStartDate():''); ?>" />
	        <div class="help-block">
	        </div>
	     </div>
	</div>

	<div class="control-group">
	     <label class="control-label">End Date</label>
	     <div class="controls">
	        <input class="input-xlarge" type="text" id="endDate" name="medication[endDate]" value="<?php echo (($medicationId != '')?$medicationDetails->getEndDate():''); ?>" />
	        <div class="help-block">
	        </div>
	     </div>
	</div>

	<div class="control-group">
		 <label class="checkbox">
			<input name="medication[activeStatus]" value="1" type="checkbox" <?php echo (($medicationId != '')?(($medicationDetails->getActiveStatus() == '1')?'checked':''):""); ?> /> Is Medication Active?
		 </label>

	</div>

	<div class="control-group">
		 <h3>Started By</h3>
		 <label class="checkbox">
			<input name="medication[startedBy]" value="1" type="radio" <?php echo (($medicationId != '')?(($medicationDetails->getStartedBy() == '1')?'checked':''):""); ?> /> current primary care dr
		 </label>
		 <label class="checkbox">
			<input name="medication[startedBy]" value="2" type="radio" <?php echo (($medicationId != '')?(($medicationDetails->getStartedBy() == '2')?'checked':''):""); ?> /> previous primary care dr
		 </label>
		 <label class="checkbox">
			<input name="medication[startedBy]" value="3" type="radio" <?php echo (($medicationId != '')?(($medicationDetails->getStartedBy() == '3')?'checked':''):""); ?> /> specialist
		 </label>
		 <label class="checkbox">
			<input name="medication[startedBy]" value="4" type="radio" <?php echo (($medicationId != '')?(($medicationDetails->getStartedBy() == '4')?'checked':''):""); ?> /> unknown
		 </label>

	</div>



	<div class="form-actions">
	    <button type="button" class="btn btn-primary addMedication_btn" personId="<?php echo $personId;?>" problemId="<?php echo $problemId;?>">Submit</button>
	</div> 


</div> 	
	

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$( "#endDate" ).datepicker({
			showOn: "button",
			buttonImage: basePath+"/assets/img/calendar.gif",
			buttonImageOnly: true
		});
		$( "#startDate" ).datepicker({
			showOn: "button",
			buttonImage: basePath+"/assets/img/calendar.gif",
			buttonImageOnly: true
		});
	});
</script>



