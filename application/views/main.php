<!DOCTYPE html>
<html>
<head>
	<title>Bill</title>
	<style type="text/css">
	@import url(/css/master.css);
<?php
if (isset($css))
	foreach ($css as $c)
		echo "	@import url('".$c."');\n";
?>
	</style>
	<script type="text/javascript" src="/js/jquery.js">1;</script>
	<script type="text/javascript" src="/js/main.js">1;</script>
	<?php
if (isset($js))
	foreach ($js as $j)
		echo '<script type="text/javascript" src="'.$j.'"></script>'."\n";
?>
	<link rel="alternate" type="application/rss+xml" href="/feed" title="RSS flöde">
</head>
<body>
<div id="wrap">
	<div id="header">
		<a href="/">
            <p id="page_title">Bill</p>
        </a>
	</div>
	<div id="menu">
		<?php echo View::factory('menu'); ?>
	</div>
	<div id="content">
		<div id="content-inner">
			<div id="content-master">
			<?=$content; ?>
			</div>
		</div>
	</div>
	<div id="footer">
		<div id="login"><?php
if (Auth::instance()->get_user()){
	echo '<a href="/user/logout/">Logga Ut</a>';
	if (Auth::instance()->get_user()->has_role('admin')) {
		echo ' | <a href="/admin/">Administration</a>';
	}
} else {
	echo '<a href="/user/login/';
	$redirect = urlencode(Request::$current->uri());
	if (!empty($redirect)) echo '?redirect='.$redirect;
	echo '">Logga in</a>';
}
?></div>
		<p><b>Bill</b></p>
	</div>
</div>
</body>
</html>