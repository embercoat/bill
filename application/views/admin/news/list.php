<table>
<thead>
	<tr>
		<th style="width: 150px">Titel</th>
		<th style="width: 150px">Publicerad</th>
		<th style="width: 150px">Författare</th>
		<th style="width: 150px">Synlig</th>
		<th style="width: 150px">&nbsp;</th>
	</tr>
</thead>
<tbody>
	<? foreach(Model::factory('news')->get_news() as $news){ ?>
	<tr>
		<td><?=$news['title']; ?></td>
		<td><?=date('Y m d H:i:s', $news['published']); ?></td>
		<td><?=user::get_username_by_id($news['author']); ?></td>
		<td><?php echo ($news['visible'] == 1 ? 'Ja' : 'Nej'); ?></td>
		<td>
			<a href="/admin/news/edit/<?=$news['id']; ?>">Edit</a>
			<a href="/admin/news/delete/<?=$news['id']; ?>" class="delete">Radera</a>
		</td>
	</tr>
	<? } ?>
</tbody>
</table>