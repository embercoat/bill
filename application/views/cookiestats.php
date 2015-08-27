<?php 
if($_SESSION['user']->getId() == 1) { //Only show for Tiny. The almighty creator.
?>
<div id="stats" style="padding: 3px;width: 400px;border: 1px solid black;position: absolute;top: 60px;left: 10px; background-color: white;">
	<span style="float:right;cursor:pointer;color:blue;" onclick="document.getElementById('stats').style.display='none';">Close</span>
    <b>Beware of the cookiemonster</b><br />
    <pre><?php var_dump($_COOKIE); ?></pre>
</div>
<?php 
}
?>