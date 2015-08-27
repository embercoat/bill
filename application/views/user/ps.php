<h1>Personliga Samtal</h1>
<table>
	<thead>
		<tr>
			<th style="width: 300px;">Företag</th>
			<th style="width: 150px;">Tid för anmälan</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($interest as $i){ ?>
		<tr>
			<td><a href="/katalog/foretag/<?php echo $i['company_id']; ?>"><?php echo $i['name']; ?></a></td>
			<td><?php echo date('d M Y H:i', $i['time']); ?></td>
		</tr>
	<?php }?>
	</tbody>
</table>