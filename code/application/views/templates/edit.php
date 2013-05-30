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
<br>
<?php if(isset($patientDetails[0])) { ?>
<img width="50" height="50" src="<?= $patientDetails[0]->getPersonObject()->getAvatarFilename();?>" />
<div><?php echo $patientDetails[0]->getPersonObject()->getGivenName();?></div>
<div><?php echo $patientDetails[0]->getPersonObject()->getBirthDate();?></div>
<br>
<span>Upload Pic</span>
<input type="file" id="avatar" class="patient_pic" name="avatar"/>
<span class="upload_status"></span> <br>
<input type="hidden" id="patient_image_file_path"/>
<br>
<span>needToKnow</span>
<textarea name="needToKnow" autofocus rows="4" cols="50" id="needToKnow"><?=$patientDetails[0]->getNeedToKnow();?></textarea>
<br>
<span>likeToKnow</span>
<textarea name="likeToKnow" autofocus rows="4" cols="50" id="likeToKnow"><?=$patientDetails[0]->getLikeToKnow();?></textarea>
<br>
<input type="button" value="Save and Edit" class="saveeditpatient">
<input type="hidden" value="<?=$personId?>" id="patient_id">
<?php }?>
