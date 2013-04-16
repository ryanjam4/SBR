<?php if ($back != ''): ?>
<a href="<?= $back; ?>"  >Back</a><br>
<?php endif; ?>
<div><span>Goal:</span><?= $goalDetails->getGoal();?></div>
<div><span>Motivation:</span><?= $goalDetails->getMotivation();?></div>
<div><span>Control Status:</span><?= $goalDetails->getControlStatus();?></div>
<div><span>Active Status:</span><?= $goalDetails->getActiveStatus();?></div>
<br>
<br>