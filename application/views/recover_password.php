<!DOCTYPE html>
<html>
<head>
	<title>LARV Login</title>
	<style type="text/css">
		@import url('/css/master.css');
		@import url('/css/form.css');
		@import url(http://fonts.googleapis.com/css?family=Questrial);
		#loginform {
		  height: 150px;
		  width: 400px;
		  color: white;
		  position: absolute;
		  top: 120px;
		  left: 300px;
		}
		#loginform label {
		  font-size: 20px;
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
	<div id="header">
		<div id="logo">
			<a href="/"><img src="/images/logo.png" alt="LARV" /></a>
		</div>
		<div id="logo-teknolog">
			<a href="http://teknologkaren.se/"><img src="/images/logo_teknologkaren.png" alt="logo_teknologkaren" /></a>
			<img src="/images/lkab.png" alt="logo_lkab" />
		</div>
	</div>
	<div id="loginform">
		<?=Form::open('/login/recover/', array('method' => 'post'))."\n"; ?>
			<p>
			Ange din epost nedan för att återskapa ditt lösenord.
				<?=Form::label('email', 'Epost')."\n"; ?>
				<?=Form::input('email', (isset($email)?$email:''))."\n"; ?>
				<?=Form::submit('submit', 'Återskapa')."\n"; ?>
			</p>
		<?=Form::close()."\n"; ?>
		<?php
		if (isset($message)) {
			echo "<p style='clear: both;'>".$message."</p>".PHP_EOL;
		}
		?>
	</div>
</div>
</body>
</html>