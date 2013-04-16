<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
<link href="<?php echo base_url('assets/css/jquery-ui.css') ?>" rel="stylesheet">
<form class="form-horizontal form-addProblem" action="<?php echo base_url('admin/updateUser');?>" method="POST">
<input class="input-xlarge" id="problemId" type="hidden" name="problem[problemId]" value="<?php echo (($problemId != '')?$problemDetails->getProblemId():''); ?>" />
<div class="problem_section">	
	<div class="control-group">
	     <label class="control-label">Search Problem</label>
	     <div class="controls">
	        <input class="input-xlarge" type="text" data-divId=".matched_terms" data-destId="#conceptId" placeholder="Please enter the search here" name="term" id="matched_terms_input" value="" />
	        <ul class="matched_terms">

	        </ul>	
	        <div class="help-block">
	        </div>
	     </div>
	</div>

	<div class="control-group">
	     <label class="control-label">Concept Id</label>
	     <div class="controls">
	        <input class="input-xlarge" id="conceptId" type="text" name="problem[conceptId]" value="<?php echo (($problemId != '')?$problemDetails->getConceptId():''); ?>" />
	        <span><?php echo (($problemId != '')?$problemDetails->getConceptObject()->getTerm():''); ?></span>
	        <div class="help-block">
	        </div>
	     </div>
	</div>
	<div class="control-group">
	     <label class="control-label">Notes on Problem</label>
	     <div class="controls">
	        <input class="input-xlarge" type="text" name="problem[notes]" value="<?php echo (($problemId != '')?$problemDetails->getNotes():''); ?>" />
	        <div class="help-block">
	        </div>
	     </div>
	</div>

	<div class="control-group">
	     <label class="control-label">Start Date</label>
	     <div class="controls">
	        <input class="input-xlarge" type="text" id="startDate" name="problem[startDate]" value="<?php echo (($problemId != '')?$problemDetails->getStartDate():''); ?>" />
	        <div class="help-block">
	        </div>
	     </div>
	</div>

	<div class="control-group">
	     <label class="control-label">End Date</label>
	     <div class="controls">
	        <input class="input-xlarge" type="text" id="endDate"  name="problem[endDate]" value="<?php echo (($problemId != '')?$problemDetails->getEndDate():''); ?>" />
	        <div class="help-block">
	        </div>
	     </div>
	</div>

	<div class="control-group">
		 <label class="checkbox">
			<input name="problem[activeStatus]" value="1" type="checkbox" <?php echo (($problemId != '')?(($problemDetails->getActiveStatus() == '1')?'checked':''):""); ?> /> Is Problem Active?
		 </label>
		 <label class="checkbox">
			<input name="problem[controlStatus]" value="1" type="checkbox" <?php echo (($problemId != '')?(($problemDetails->getControlStatus() == '1')?'checked':''):""); ?>> Is this Problem Controlled?
		 </label>
	</div>
	<div class="form-actions">
	    <button type="button" class="btn btn-primary addProgram_btn" personId="<?php echo $personId;?>">Submit</button>
	</div>  
</div>

	
	<iframe src="http://www.snomedbrowser.com/" width="100%" height="500"></iframe>

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





