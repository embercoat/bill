<?
$alternator = 0; ?>
<a href="#" onclick="addSkill()">Add Skill</a>
<table>
	<thead>
		<tr>
			<td style="width: 200px;">Skill</td>
			<td style="width: 550px;">Description</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
<?  foreach($skills as $s){  ?>
		<tr <?=(++$alternator%2 == 0) ? 'style="background-color: silver"' : '' ?>>
			<td id="skill_<?=$s['sid'] ?>"><?=$s['name'] ?></td>
			<td id="desc_<?=$s['sid'] ?>"><?=$s['desc'] ?></td>
			<td>
				<a href="/admin/data/delSkill/<?=$s['sid'].'/'; ?>" class="delete">
					Radera
				</a>
				<a href="#" onclick="editSkill(<?=$s['sid']; ?>)">
					Edit
				</a>
			</td>
		</tr>
<? } ?>
	</tbody>
</table>
<div style="position: fixed; top: 200px; left: 600px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
	<form action="/admin/data/editSkill/" method="post">
		<?= Form::hidden('skill_id', ''); ?>
		<?= Form::hidden('oldname', ''); ?>
		<?= Form::hidden('oldurl', ''); ?>
		<?= Form::label('newname', 'Namn'); ?>
		<?= Form::input('newname', ''); ?>
		<?= Form::label('desc', 'Description'); ?>
		<?= Form::input('desc', ''); ?>

		<?= Form::submit('save', 'Spara'); ?>
	</form>
	<?= Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>