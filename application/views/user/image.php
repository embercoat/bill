<?php

echo Form::open('/user/image',  array('enctype' => 'multipart/form-data'))
	.Form::label('image', 'Profilbild')
	.Form::file('image')
	.Form::submit('submit', 'Ladda Upp')
	.Form::close();
?>
<div style="float: left; clear: both;">
<?php 
if(user::find_user_image($_SESSION['user']->getId())){
	?>
	<a href="/<?=user::find_user_image($_SESSION['user']->getId()); ?>">Din nuvarande bild</a>
	<?php
} else {
	?>
	Du har ingen bild uppladdad.
	<?php 
}
?>
</div>