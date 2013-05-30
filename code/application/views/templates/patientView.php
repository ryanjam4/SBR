<img src="<?=$patientDetails[0]->getPersonObject()->getCoverImage();?>"/><br>
<script type="text/javascript" src="<?php echo base_url('assets/js/ajax_file_upload.js') ?>"></script>
<div class="action-menu">
  <?php if($permissionObject->checkUserPermission($personRole,'edit_profile')): ?>
  <a href="<?php echo base_url('patient/edit'); ?>"  class="edit_user">Edit</a>
  <?php endif; ?>
  <?php if($permissionObject->checkUserPermission($personRole,'edit_profile')): ?>
  <a href="<?php echo base_url('admin/editUser?personId='.$patientDetails[0]->getPersonObject()->getPersonId()); ?>"  class="edit_user">Edit user</a>
  <?php endif; ?>
  <?php if($permissionObject->checkUserPermission($personRole,'add_problem')) : ?>
  <a href="<?php echo base_url('problem/add/'.$patientDetails[0]->getPersonObject()->getPersonId()); ?>">Add Problem</a>
  <?php endif; ?>
  <a href="<?php echo $facebookLoginUrl ;?>">Login with facebook</a> </div>
  <a href="<?php echo base_url('patient/aboutme') ;?>">About Me</a> </div>
<br>
<?php if(isset($patientDetails[0])) { ?>
<img width="50" height="50" src="<?= $patientDetails[0]->getPersonObject()->getAvatarFilename();?>" />
<div><?php echo $patientDetails[0]->getPersonObject()->getGivenName();?></div>
<div><?php echo $patientDetails[0]->getPersonObject()->getBirthDate();?></div>
<br>
<div class="problems"> <span>Problems</span>
  <?php if($patientDetails[0]->getConceptObject()->getTerm() != "") { ?>
  <?php foreach ($patientDetails as $key=>$value): ?>
  <div class="<?php echo (($value->getProblemObject()->getControlStatus() == 1) ? 'green':'red'); ?>"> <a href="<?php echo base_url('problem/detail/'.$value->getProblemObject()->getProblemId()); ?>"><?php echo $value->getConceptObject()->getTerm();?></a>
    <?php if($permissionObject->checkUserPermission($personRole,'update_problem')): ?>
    <a href="<?php echo base_url('problem/edit/'.$value->getPersonObject()->getPersonId()."/".$value->getProblemObject()->getProblemId()); ?>"> - Edit</a>
    <?php endif; ?>
    <?php if($permissionObject->checkUserPermission($personRole,'delete_problem')) : ?>
    <a href="#" class="delete_problem" data-problemid="<?php echo $value->getProblemObject()->getProblemId(); ?>" > - Delete</a>
    <?php endif; ?>
  </div>
  <?php endforeach; ?>
  <?php } ?>
</div>
<br>
<br>
<hr>
<div class="problems"> <span>UnApproved Problems</span>
  <?php if(isset($unApprovedProblems[0])) { ?>
  <?php foreach ($unApprovedProblems as $key=>$value): ?>
  <div class="<?php echo (($value->getProblemObject()->getControlStatus() == 1) ? 'green':'red'); ?>"> <a href="<?php echo base_url('problem/detail/'.$value->getProblemObject()->getProblemId()); ?>"><?php echo $value->getConceptObject()->getTerm();?></a>
    <?php if($permissionObject->checkUserPermission($personRole,'update_problem')): ?>
    <a href="<?php echo base_url('problem/edit/'.$value->getPersonObject()->getPersonId()."/".$value->getProblemObject()->getProblemId()); ?>"> - Edit</a>
    <?php endif; ?>
    <?php if($permissionObject->checkUserPermission($personRole,'delete_problem')) : ?>
    <a href="#" class="delete_problem" data-problemid="<?php echo $value->getProblemObject()->getProblemId(); ?>" > - Delete</a>
    <?php endif; ?>
    <?php
			if($personRole == 1) {
				echo '<a href="#" class="approve_problem" data-problemid="'.$value->getProblemObject()->getProblemId().'" >  - Aprrove</a>';
			}
		?>
  </div>
  <?php endforeach; ?>
  <?php } ?>
</div>
<?php } ?>
<br>
<br>
<span>Goals</span>
<?php 
if(count($personGoals)>0){
foreach ($personGoals as $key=>$value): ?>
<div class="<?php echo (($value->getControlStatus() == 1) ? 'green':'red'); ?>">
  <div><a href="<?= base_url('/goal/detail/'.$value->getGoalId())?>">
    <?= $value->getGoal();?>
    </a> </div>
  <a href="<?= base_url('goal/edit/'.$value->getGoalId())?>">Edit</a>
  <?php if($permissionObject->checkUserPermission($personRole,'delete_goal')) { ?>
  <a href="#" class="delete_goal" data-goalid="<?=$value->getGoalId();?>">Delete</a>
  <?php } ?>
</div>
<br>
<br>
<?php endforeach; 
}
?>
<br>
