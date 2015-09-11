
<?php 

$hostName = $_SERVER['HTTP_HOST'];

 ?>

<?php if (1): ?>
	<a href="<?=URL::to('/auth/login')?>" title="">Login</a>
	<a href="<?=URL::to('/auth/register')?>" title="">Registreer</a>
<?php endif ?>


<a href="<?=URL::to('/about"')?> title="">About</a>
