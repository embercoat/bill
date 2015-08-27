<!DOCTYPE html>
<html>
<head>
	<title>Skills Login</title>
	<style type="text/css">
		@import url('/css/master.css');
		@import url('/css/form.css');
		@import url(http://fonts.googleapis.com/css?family=Questrial);
		#loginform {
		  height: 150px;
		  width: 400px;
		  color: white;
		  /*position: absolute;
		  top: 120px;
		  left: 300px;*/
		  margin: auto;
		  margin-top: 200px;
		}
		#loginform label {
		  font-size: 20px;
		  color: black;
		}
		#loginform .error {
		  color: red;
		  clear: both;
		}
	</style>
	<script type="text/javascript" src="/js/jquery.js">1;</script>
	<script type="text/javascript">
    $(document).ready(function(){
        $("#username").focus();
    });
	</script>
</head>
<body>
<div id="wrap">
	<div id="loginform">
		<?=Form::open('/login/login/', array('method' => 'post'))."\n"; ?>
			<p>
				<?=Form::hidden('redirect', (isset($redirect)?$redirect:''))."\n"; ?>
				<?=Form::label('username', 'Användarnamn')."\n"; ?>
				<?=Form::input('username', (isset($username)?$username:''))."\n"; ?>
				<?=Form::label('password', 'Lösenord')."\n"; ?>
				<?=Form::password('password')."\n"; ?>
				<?=Form::submit('submit', 'Logga In')."\n"; ?>
			</p>
		<?=Form::close()."\n"; ?>
		<p style="float: left; clear: both;color: black;">
			Ingen användare? <a href="/register" >Registrera dig!</a><br />
			<a href="/login/recover" style="color: white;">Glömt Lösenord</a>
		</p>
		<?php
		if ($attempt) {
			echo "<p class=\"error\">Felaktigt användarnamn eller lösenord!</p>\n";
		}
		?>
	</div>
</div>
</body>
</html>