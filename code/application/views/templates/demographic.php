<?php if($permissionObject->checkUserPermission($loggedInUserRole,'edit_profile')): ?>
   <a href="<?php echo base_url('admin/editUser?personId='.$user_details->getPersonId()); ?>"  class="edit_user">Edit user</a>
<?php endif; ?>
   <div class="demographic">  
      <input class="input-xlarge" type="hidden" name="personId" value="<?php echo $user_details->getPersonId(); ?>" />
      
      <div class="control-group">
      	<label class="control-label">First Name</label>
      	<div class="controls">
				<span><?php echo $user_details->getGivenName(); ?> </span>
            <div class="help-block">
            </div>
			</div>
      </div>

      <div class="control-group">
         <label class="control-label">Middle Name</label>
         <div class="controls">
            <span><?php echo $user_details->getMiddleName(); ?> </span>
            <div class="help-block">
            </div>
         </div>
      </div>

      <div class="control-group">
         <label class="control-label">Last Name</label>
         <div class="controls">
            <span><?php echo $user_details->getFamilyName(); ?> </span>
            <div class="help-block">
            </div>
         </div>
      </div>
      <div class="control-group">
         <img width="50" height="50" src="<?= $user_details->getAvatarFilename() ?>"/></span>              
         <span class="upload_status"></span>
      </div>   
      <div class="control-group">
         <label class="control-label">DOB</label>
         <div class="controls">
            <span><?php echo $user_details->getBirthDate(); ?> </span>
            <div class="help-block">
            </div>
         </div>
      </div>

      <div class="control-group">
         <label class="control-label">Address</label>
         <div class="controls">
            <span><?php echo $user_details->getAddressLine1(); ?> </span>
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">City</label>
         <div class="controls">
            <span><?php echo $user_details->getCity(); ?> </span>
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">County</label>
         <div class="controls">
            <span><?php echo $user_details->getCounty(); ?> </span>
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">State</label>
         <div class="controls">
            <span><?php echo $user_details->getState(); ?> </span>
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">zipCode</label>
         <div class="controls">
            <span><?php echo $user_details->getZip4(); ?> </span>
            <div class="help-block">
            </div>
         </div>
        
      </div>
   <div class="control-group">
      <label class="control-label">Sex</label>
      <label class="radio inline">
          <?php echo $user_details->getSex();?> 
        </label>
   </div>   
   <div class="control-group">
         <label class="control-label">Phone Number</label>
         <div class="controls">
            <span><?php echo $user_details->getAreaCode(); ?> </span>
            <span><?php echo $user_details->getExchangeCode(); ?></span>
            <span><?php echo $user_details->getLocalNumber(); ?> </span>
            <div class="help-block">
            </div>
         </div>
   </div>
   <div class="control-group">
         <label class="control-label">Email</label>
         <div class="controls">
            <span><?php echo $user_details->getEmailAddress(); ?> </span>
            <div class="help-block">
            </div>
         </div>
   </div>
</div>   
   

