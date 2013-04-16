<br><br>
<form name="goal_form" id="goal_form">
 Goal:<input type="text" name="goal[goal]" value="<?php echo (($goalId != '')?$goalDetails->getGoal():''); ?>"/><br>
 Motivation:<input type="text" name="goal[motivation]" value="<?php echo (($goalId != '')?$goalDetails->getMotivation():''); ?>"/><br>
 <input type="hidden" name="goal[conceptId]" value="<?php echo (($goalId != '')?$goalDetails->getConceptId():$problemDetails->getConceptId()); ?>">
 <input type="hidden" class="problemId" name="goal[problemId]" value="<?php echo (($goalId != '')?$goalDetails->getProblemId():$problemDetails->getProblemId()); ?>">
 <?php if ($goalId != ''): ?>
 <input type="hidden" class="goalId" name="goal[goalId]" value="<?=$goalId?>">
 <a href="<?=base_url('problem/detail/'.$goalDetails->getProblemId())?>">Problem Detail</a>
 <?php endif; ?>
 <br>

 <div class="control-group">
		 <label class="checkbox">
			<input name="goal[activeStatus]" value="1" type="checkbox" <?php echo (($goalId != '')?(($goalDetails->getActiveStatus() == '1')?'checked':''):""); ?> /> Is Goal Active?
		 </label>
		 <label class="checkbox">
			<input name="goal[controlStatus]" value="1" type="checkbox" <?php echo (($goalId != '')?(($goalDetails->getControlStatus() == '1')?'checked':''):""); ?>> Is this Goal Controlled?
		 </label>
</div>
 <input type="button" value="save" class="add_goal">
</form>