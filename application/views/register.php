<?php
	if(isset($register_success))
	{
		 if(!$register_success){
			?>Det har uppstått fel.<ul><?php
			foreach($error as $e){
			?>
				<li><?=$e; ?></li>
			<?php
			?></ul><?php
			}
		 } else { ?>
		 	<p>Grattis <?=$name; ?>. Du är nu registrerad och inloggad på Skills!</p>
		 <?php }
	}
	if(!isset($register_success) || !$register_success){

		echo Form::open('/register/', array('method' => 'post'))

			.Form::label('fname', 'Förnamn')
			.Form::input('fname', (isset($_POST['fname']) ? $_POST['fname'] : ''))

			.Form::label('lname', 'Efternamn')
			.Form::input('lname', (isset($_POST['lname']) ? $_POST['lname'] : ''))

			.Form::label('username', 'Användarnamn')
			.Form::input('username', (isset($_POST['username']) ? $_POST['username'] : ''))

			.Form::label('password', 'Lösenord')
			.Form::password('password', (isset($_POST['password']) ? $_POST['password'] : ''))

			.Form::label('password2', 'Bekräfta lösenord')
			.Form::password('password2', (isset($_POST['password2']) ? $_POST['password2'] : ''))

			.Form::label('email', 'Epostadress')
			.Form::input('email', (isset($_POST['email']) ? $_POST['email'] : ''))

			.Form::submit('submit', 'Registrera')
			.Form::close();
	}
?>
