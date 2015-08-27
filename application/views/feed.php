<?php

$info = array(
	'title' => 'LARV',
	'link' => 'http://larv.org/',
	'description' => 'Följ nyheterna från LARV.'
);

$items = array();
foreach (Model::factory('news')->get_news(5) as $news) {
	$items[] = array(
		'title' => $news['title'],
		'link' => 'http://larv.org/',
		'description' => $news['text'],
		'pubDate' => date('D, j m Y H:i:s e', $news['published']),
		'author' => "{$news['fname']} {$news['lname']}",
	);
}


echo Kohana_Feed::create($info, $items);
