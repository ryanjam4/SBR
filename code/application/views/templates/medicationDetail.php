<a href="<?php echo base_url('patient/index/'.$medicationDetails->getPersonObject()->getPersonId()); ?>"  ><img width="50" height="50" src="<?= $medicationDetails->getPersonObject()->getAvatarFilename();?>" /></a>
<div><span >Given Name:</span><?php echo $medicationDetails->getPersonObject()->getGivenName();?></div>

<div><span>Birth Date:</span><?php echo $medicationDetails->getPersonObject()->getBirthDate();?></div>

<div><span>Problem Name:</span><?php echo $medicationDetails->getConceptObject()->getTerm();?></div>

<div><span>activeStatus:</span><?php echo $medicationDetails->getActiveStatus();?></div>

<div><span>notes:</span><?php echo $medicationDetails->getNotes();?></div>
<div><span>Start Date:</span><?php echo $medicationDetails->getStartDate();?></div>
<div><span>End Date:</span><?php echo $medicationDetails->getEndDate();?></div>
<div><span>End Date:</span><?php echo $medicationDetails->getEndDate();?></div>

<div>
	<span>startedBy:</span>
	<?php if ($medicationDetails->getStartedBy() == '1'): ?>

	<h3>current primary care dr</h3>

	<?php elseif ($medicationDetails->getStartedBy() == '2'): ?>

	<h3>previous primary care dr</h3>

	<?php elseif ($medicationDetails->getStartedBy() == '3'): ?>

	<h3>specialist</h3>

	<?php else: ?>

	<h3>unknown</h3>

	<?php endif; ?>
</div>


