<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Bill - Admin</title>
		<style type="text/css">
			@import url('/css/resethtml5.css');
			@import url('/css/adminstyle.css');
			@import url('/css/form.css');
<?php
	if(isset($css))
		foreach($css as $c)
			echo '			@import url(\''.$c.'\');'."\r\n";
?>
        	</style>

        <script type="text/javascript" src="/js/jquery.js">1;</script>
        <?php
            if(isset($js))
                foreach($js as $j)
                    echo '<script type="text/javascript" src="'.$j.'">1;</script>'."\r\n";
        ?>
        <script type="text/javascript" src="/js/mainAdmin.js">1;</script>
    </head>
<body>
	<div id="topBanner">
		<a href="/"style="float: left;">Bill</a>
		<h1 style="display:inline; float: left; margin-top: 10px; margin-left:165px;">Adminpanel</h1>
	</div>
	<div id="container">
		<div id="nav-local">
			<ul>
				<li><a href="/admin/">Start</a></li>
			</ul>
			<ul>
				<li><a href="/admin/user/">Användare</a></li>
				<li><a href="/admin/user/create">Skapa</a></li>
			</ul>
			<ul>
				<li><a href="/admin/">Stats</a></li>
          <li><a href="/admin/stats/userstats">Per Användare</a></li>
			</ul>
			<ul>
				<li><a href="#">Data</a></li>
				<li><a href="/admin/dynamic/">Dynamiska Sidor</a></li>
				<li><a href="/admin/values/">Värden</a></li>
				<li><a href="/admin/data/skills">Skills</a></li>
        <li><a href="/admin/data/skills">Skills</a></li>
			</ul>
		</div>
		<div id="content">
		<?php
			if(isset($_SESSION['message'])){
				echo "<ul>\r\n";
			    foreach($_SESSION['message'] as $class => $cont)
			    	foreach($cont as $m)
			      		echo '<li class="'.$class.'">'.$m.'</li>';
			     echo "</ul>";
			}
			unset($_SESSION['message']);
			?>
			<?=$content; ?>
		</div>
	</div>
</body>
</html>