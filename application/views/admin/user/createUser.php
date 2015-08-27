<div style="float: left;">
<?php 
echo Form::open('/admin/user/create')
	
	.Form::label('username', 'Användarnamn')
	.Form::input('username', (isset($_POST['username']) ? $_POST['username'] : ''))
	
	.Form::label('password', 'Lösenord')
	.Form::password('password', (isset($_POST['password']) ? $_POST['password'] : ''))

	.Form::label('usertype', 'Användartyp')
	.Form::select('usertype', 
		array(
			1 => 'Student',
			2 => 'Företag',
			3 => 'Admin'
		)
	)

	.Form::submit('submit', 'Registrera')
	.Form::close();
		
?>
</div>