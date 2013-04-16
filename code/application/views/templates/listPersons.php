<a href="<?php echo base_url("account/registerUser")?>">add User</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="sort <?php echo ($sortBy =='givenName' ? 'selected' : ''); ?>" sortBy='givenName' sortOrder="<?php echo ($sortOrder =='asc' ? 'desc' : 'asc'); ?>">First Name</th>
          <th class="sort <?php echo ($sortBy =='familyName' ? 'selected' : ''); ?>" sortBy='familyName' sortOrder="<?php echo ($sortOrder =='asc' ? 'desc' : 'asc'); ?>">Last Name</th>
          <th class="sort <?php echo ($sortBy =='login' ? 'selected' : ''); ?>" sortBy='login' sortOrder="<?php echo ($sortOrder =='asc' ? 'desc' : 'asc'); ?>">Username</th>
          <th class="sort <?php echo ($sortBy =='birthDate' ? 'selected' : ''); ?>" sortBy='birthDate' sortOrder="<?php echo ($sortOrder =='asc' ? 'desc' : 'asc'); ?>">Date of birth</th>
          <th class="sort <?php echo ($sortBy =='sex' ? 'selected' : ''); ?>" sortBy='sex' sortOrder="<?php echo ($sortOrder =='asc' ? 'desc' : 'asc'); ?>">Sex</th>
          <th>Contact Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
       <?php foreach ($userList as $key=>$value): ?> 
        <tr>
          <td><?php echo $value->getGivenName(); ?></td>
          <td><?php echo $value->getFamilyName(); ?></td>
          <td><?php echo $value->getLogin(); ?></td>
          <td><?php echo $value->getBirthDate(); ?></td>
          <td><?php echo $value->getSex(); ?></td>
          <td><?php echo $value->getAreaCode(); ?>-<?php echo $value->getExchangeCode(); ?>-<?php echo $value->getLocalNumber(); ?></td>
          <td>
            <a href="#" personId="<?php echo $value->getPersonId(); ?>" class="delete_user">Delete user</a><br>
            <a href="<?php echo base_url('admin/editUser?personId='.$value->getPersonId()); ?>"  class="edit_user">Edit user</a>
            <div class="clearFloat"></div>            
          </td>
        </tr>        
      <?php endforeach; ?>  
      </tbody>
    </table>   
    <div class="pagination">    
        <?php echo $paginationHTML; ?>
    </div>