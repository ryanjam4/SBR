<?php if($permissionObject->checkUserPermission($personRole,'add_goal')): ?>
	<a href="<?php echo base_url("goal/create/".$problemDetails->getProblemId());?>" >Add Goal</a>
<?php endif; ?>
<?php if($permissionObject->checkUserPermission($personRole,'add_medication')): ?>
	<a href="<?php echo base_url("medication/add/".$problemDetails->getPersonObject()->getPersonId()."/".$problemDetails->getProblemId());?>" >Add Medication</a>
<?php endif; ?>
<div class="clearFloat"></div>
<br>
<a href="<?php echo base_url('patient/index/'.$problemDetails->getPersonObject()->getPersonId()); ?>"  ><img width="50" height="50" src="<?= $problemDetails->getPersonObject()->getAvatarFilename();?>" /></a>
<div><span >Given Name:</span><?php echo $problemDetails->getPersonObject()->getGivenName();?></div>

<div><span>Birth Date:</span><?php echo $problemDetails->getPersonObject()->getBirthDate();?></div>

<div><span>Problem Name:</span><?php echo $problemDetails->getConceptObject()->getTerm();?></div>

<div><span>controlStatus:</span><?php echo $problemDetails->getControlStatus();?></div>
<div><span>activeStatus:</span><?php echo $problemDetails->getActiveStatus();?></div>


<div><span>Start Date:</span><?php echo $problemDetails->getStartDate();?></div>
<div><span>End Date:</span><?php echo $problemDetails->getEndDate();?></div>
<div><span>notes:</span><?php echo $problemDetails->getNotes();?></div>
<br><br><br>


<span>Goals</span>

<?php 
if(count($problemGoals)>0){
foreach ($problemGoals as $key=>$value): ?>
<div class="<?php echo (($value->getControlStatus() == 1) ? 'green':'red'); ?>"> 
<div><a href="<?= base_url('/goal/detail/'.$value->getGoalId())?>"><?= $value->getGoal();?></a>
<a href="<?= base_url('/goal/detail/'.$value->getGoalId())?>">view</a>
<a href="<?= base_url('goal/edit/'.$value->getGoalId())?>">Edit</a>
<?php if($permissionObject->checkUserPermission($personRole,'delete_goal')) { ?>
<a href="#" class="delete_goal" data-goalid="<?=$value->getGoalId();?>">Delete</a>
<?php } ?>
</div>
<br>
<br>
</div>
<?php endforeach; 
}
?> 
<br>
<br><br><br>
<div class="medications">
	<span>Medications</span>

	<?php foreach ($medicationDetails as $key=>$value): ?> 
	<div class="<?php echo (($value->getActiveStatus() == 1) ? 'green':'red'); ?>">
		<a href="<?php echo base_url('medication/detail/'.$value->getMedicationId()); ?>"><?php echo $value->getConceptObject()->getTerm();?></a>
		<?php if($permissionObject->checkUserPermission($personRole,'update_medication')): ?>
			<a href="<?php echo base_url('medication/edit/'.$problemDetails->getPersonObject()->getPersonId()."/".$value->getMedicationId()); ?>">  -  Edit</a>
		<?php endif; ?>
		<?php if($permissionObject->checkUserPermission($personRole,'delete_medication')): ?>		
			<a href="#" class="delete_medication" data-medicationId="<?php echo $value->getMedicationId();?>" >  - Delete</a>
		<?php endif; ?>
	</div>
	<?php endforeach; ?>  	
</div>
<br><br><br>
<div class="medications">
	<span>Un Approved Medications</span>

	<?php foreach ($unApprovedMedications as $key=>$value): ?> 
	<div class="<?php echo (($value->getActiveStatus() == 1) ? 'green':'red'); ?>">	
		<a href="<?php echo base_url('medication/detail/'.$value->getMedicationId()); ?>"><?php echo $value->getConceptObject()->getTerm();?></a>
		<?php if($permissionObject->checkUserPermission($personRole,'update_medication')): ?>
			<a href="<?php echo base_url('medication/edit/'.$problemDetails->getPersonObject()->getPersonId()."/".$value->getMedicationId()); ?>">  -  Edit</a>
		<?php endif; ?>
		<?php if($permissionObject->checkUserPermission($personRole,'delete_medication')): ?>		
			<a href="#" class="delete_medication" data-medicationId="<?php echo $value->getMedicationId();?>" >  - Delete</a>
		<?php endif; ?>
		<?php 
			if($personRole == 1) {
				echo '<a href="#" class="approve_medication" data-medicationid="'.$value->getMedicationId().'" >  - Aprrove</a>';
			}
		?>
	</div>
	<?php endforeach; ?>  	
</div>

<br><br><br>
<div class="medications">
	<span>Problem Guidelines</span>

	<?php foreach ($problemGuidelines as $key=>$value): ?> 
	<div><?php echo $value->getGuideline(); ?></div>
	<?php endforeach; ?>  	
</div>

<br><br><br>
