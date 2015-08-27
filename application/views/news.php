<div id="content-program">
				<? $program = Model::factory('dynamic')->get_content_by_name('parts.program'); echo $program['content']; ?>
			</div>
<? foreach($newsList as $news){ ?>
<div class="story">
	<h1><?=$news['title']; ?></h1>
	<p class="date"><?=date('Y-m-d h:i', $news['published']); ?></p>
	<?=$news['text']; ?>
</div>
<? } ?>