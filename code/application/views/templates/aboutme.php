<?php foreach ($facebookData as $key=>$value): ?>
<div class="fbObjectTitle"><?php echo ((count($value)>0))?$key:"";?></div>
<div class="clearFloat"></div>
<div class="fbOjectContent">
  <?php foreach ($value as $rindex=>$row): ?>
  <span><?php echo $row->name;?></span><br>
  <?php endforeach; ?>
</div>
<?php endforeach; ?>