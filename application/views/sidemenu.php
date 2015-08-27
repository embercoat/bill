<?php

$controller = Request::$current->controller();

$sidemenu = array();
foreach (Model::factory('sidemenu')->get_sidemenu($controller, true) as $item) {
	$url = "/$controller/".($item['action']=='index'?'':$item['action'].'/');
	// if action contains /, simply use it as the url
	if (strpos($item['action'],'/') !== false) {
		$url = $item['action'];
	}

	$sidemenu[] = array(
		'content' => $item['text'],
		'attributes' => array(
			'href' => $url
		)
	);
}

$action = Request::$current->action();

echo "<ul>\n";
foreach ($sidemenu as $alt) {
	echo "	<li><a ";
	foreach($alt['attributes'] as $att => $value) {
		echo $att.'="'.$value.'"';
	}
	if ($alt['attributes']['href'] == "/".Request::$current->uri()."/") {
		echo ' class="active"';
	}
	echo '><span>'.$alt['content'].'</span></a></li>'."\n";
}
echo "</ul>\n";

