<div style="width: 320px; margin: 0 auto;">
   <h3>Login</h3>
   <?php if (!empty($error)): ?>
      <div class="alert alert-error">
         <b>Error!</b> <?php $error ?>
      </div>
   <?php elseif (!empty($info)): ?>
      <div class="alert alert-info">
         <b>Info.</b> <?php $info ?>
      </div>
   <?php endif; ?>
   <form class="form-signin" method="POST">
        <h2 class="form-signin-heading"></h2>
        <input type="text" name="login" class="input-block-level" placeholder="Username">
        <input type="password" name="password" class="input-block-level" placeholder="Password">            
        <button class="btn btn-large btn-primary btn_sign" type="button">Sign in</button>
   </form>
</div>
