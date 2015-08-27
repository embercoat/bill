<div style="float: left;">
<h1>Användare: <?php echo $user['username']; ?></h1>
<br />
<?php 
//var_dump($user);

echo Form::open('/admin/user/detail/'.$user['id'], array('method' => 'post'))
			
			.Form::label('firstname', 'Förnamn')
			.Form::input('firstname', $user['firstname'])
			
			.Form::label('lastname', 'Efternamn')
			.Form::input('lastname', $user['lastname'])
			
			.Form::label('email', 'Epostadress')
			.Form::input('email', $user['email'])
			
//			.Form::label('phone', 'Telefonnummer')
//			.Form::input('phone', $user['phone'])
			
			.Form::label('usertype', 'Användartyp');
?>
    <div id="roles">
        <?php foreach ($roles as $role) {
            ?>
            <div class="roles"><?=
                Form::label('role['.$role['id'].']', $role['description']).
                Form::checkbox('role['.$role['id'].']', $role['id'], in_array($role['id'], $user_roles)); ?></div>

        <?php } ?>
        </div>
    <?php

			echo Form::submit('submit', 'Uppdatera')
			.Form::close()
			.Form::button('pwd', 'Byt Lösenord', array('onclick' => 'showPasswordBox()'));




?>
</div>
<div class="preHidden" id="changeUserPassword">
<?php
echo Form::open('/admin/user/changePassword')
	.Form::hidden('id', $user['id'])
	.Form::label('newPassword', 'Nytt Lösenord')
	.Form::password('newPassword')
	.Form::label('newPassword2', 'Igen')
	.Form::password('newPassword2')
	.Form::submit('submit', 'Byt Lösenord')
	.Form::close();
?>
</div>