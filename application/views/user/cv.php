<?php
echo Form::open('/user/cv',  array('enctype' => 'multipart/form-data'))
	.Form::label('cv', 'CV')
	.Form::file('cv')
	.Form::submit('submit', 'Ladda Upp')
	.Form::close();
?>
<div style="float: left; clear: both;">
<?php 
if(user::find_user_cv($_SESSION['user']->getId())){
	?>
	<a href="/<?=user::find_user_cv($_SESSION['user']->getId()); ?>">Ditt Nuvarande CV</a>
	<?php
} else {
	?>
	Du har inget cv uppladdat
	<?php 
}
?>
<p><strong>Begränsningar:</strong> Dokumentet måste vara pdf och får vara högst <?php echo ini_get('upload_max_filesize'); ?></p>
</div>