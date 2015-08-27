<table>
	<thead>
		<tr>
			<th style="width: 180px;">Företag</th>
			<th style="width: 280px;">Program</th>
			<th style="width: 150px;">Rum</th>
			<th style="width: 150px;">Tid</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $u){
		     ?>
		<tr class="<?php echo ($u['company_request'] == 1 ? 'ps_firsthand' : ($u['company_request'] == 2 ? 'ps_secondhand' : '')); ?>">
			<td><?php echo $u['companyname']; ?></td>
			<td><?php echo $programs[$u['programId']]; ?></td>
			<td><?php echo $rooms[$u['room']]; ?></td>
			<td><?php echo $periods[$u['period']]; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
