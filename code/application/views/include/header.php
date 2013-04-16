<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">

   <title>User Management System</title>

   <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">

   <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>	
   <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
   <meta HTTP-EQUIV="Expires" CONTENT="-0">
</head>
<body>
   <script type="text/javascript">
      var basePath = "<?php echo base_url();?>";
      basePath = basePath.replace(/\/$/, "");
   </script>
<?php 
if($loggedInUserRole == 1){
   echo '<a href="'.base_url("/admin/listUsers").'">Admin Page</a><br>';
}
?>
<div class="content">

