<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
<link href="<?php echo base_url('assets/css/jquery-ui.css') ?>" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url('assets/js/ajax_file_upload.js') ?>"></script>
<form class="form-horizontal form-registration"  action="createNewUser" method="POST">

      <div class="control-group">
         <label class="control-label">User Role</label>
         <br>
         <?php if($loggedInUserRole == 1): ?>
         <label class="radio inline">
          <input type="radio" name="role" class="roleCheckBox"  value="1" checked>
            Health Care specialist(Admin)
        </label>
        <label class="radio inline">
          <input type="radio" name="role" class="roleCheckBox"  value="3" >
            Limited access user
        </label>
        <?php endif; ?>       
        
        <label class="radio inline">
          <input type="radio" name="role" class="patientCheckBox"  value="2" >
            Patient
        </label>
        <br>
      </div>
      <div class="control-group">
         <label class="control-label">User Name</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="login" value="" />
            <div class="help-block">
            </div>
         </div>
      </div>
      <div class="control-group">
         <label class="control-label">Password</label>
         <div class="controls">
            <input class="input-xlarge" type="password" name="password" value="" />
            <div class="help-block">
            </div>
         </div>
      </div>

      <div class="control-group hidden patientPasswords">
         <label class="control-label">Demographic Password</label>
         <div class="controls">
            <input class="input-xlarge" type="password" name="DGPassword" value="" />
            <div class="help-block">
            </div>
         </div>
      </div>

      <div class="control-group hidden patientPasswords">
         <label class="control-label">Overview Password</label>
         <div class="controls">
            <input class="input-xlarge" type="password" name="OVPassword" value="" />
            <div class="help-block">
            </div>
         </div>
      </div>
      <div class="control-group">
      	<label class="control-label">First Name</label>
      	<div class="controls">
				<input class="input-xlarge" type="text" name="givenName" value="" />
            <div class="help-block">
            </div>
			</div>
      </div>

      <div class="control-group">
         <label class="control-label">Middle Name</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="middleName" value="" />
            <div class="help-block">
            </div>
         </div>
      </div>

      <div class="control-group">
         <label class="control-label">Last Name</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="familyName" value="" />
            <div class="help-block">
            </div>
         </div>
      </div>
      <div class="control-group">
         <span class="btn btn-success fileinput-button">
              <i class="icon-plus icon-white"></i>
              <span>Upload Pic</span>              
              <input type="hidden" name="avatarFilename" id="avatar_filename" value="" />
         </span>
         <input type="file" id="avatar" class="avatar" name="avatar"/>
         <span class="upload_status"></span>
      </div>   
      <div class="control-group">
         <label class="control-label">DOB</label>
         <div class="controls">
            <input class="input-xlarge" type="text" id="birthDate" name="birthDate" value="" />
            <div class="help-block">
            </div>
         </div>
      </div>

      <div class="control-group">
         <label class="control-label">Address</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="addressLine1" value="" />
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">City</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="city" value="" />
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">County</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="county" value="" />
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">State</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="state" value="" />
            <div class="help-block">
            </div>
         </div>
         <label class="control-label">zipCode</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="zip4" value="" />
            <div class="help-block">
            </div>
         </div>
         
      </div>
   <div class="control-group">
      <label class="control-label">Sex</label>
      <label class="radio inline">
          <input type="radio" name="sex"  value="Male" checked>
            Male
        </label>
        <label class="radio inline">
          <input type="radio" name="sex"  value="Female" checked>
            Female
        </label>
   </div>   
   <div class="control-group">
         <label class="control-label">Phone Number</label>
         <div class="controls">
            <input class="input-small" type="text" maxlength="3" name="areaCode" value="" />
            <input class="input-small" type="text" maxlength="3" name="exchangeCode" value="" />
            <input class="input-small" type="text" maxlength="4" name="localNumber" value="" />
            <div class="help-block">
            </div>
         </div>
   </div>
   <div class="control-group">
         <label class="control-label">Email</label>
         <div class="controls">
            <input class="input-xlarge" type="text" name="emailAddress" value="" />
            <div class="help-block">
            </div>
         </div>
   </div>
   <div class="form-actions">
      <button type="button" class="btn btn-primary register_btn">Submit</button>
   	<a onclick="history.go(-1)" class="btn">Cancel</a>
   </div>
</form>
<script type="text/javascript">
  $(document).ready(function(){
    $( "#birthDate" ).datepicker({
      showOn: "button",
      buttonImage: basePath+"/assets/img/calendar.gif",
      buttonImageOnly: true
    });
  });
</script>