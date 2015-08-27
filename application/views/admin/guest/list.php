<table>
	<thead>
		<tr>
			<th style="width: 150px;">Förnamn</th>
			<th style="width: 150px;">Efternamn</th>
			<th style="width: 150px;">Antal till Ceremoni</th>
			<th style="width: 150px;">Antal till Bankett</th>
			<th style="width: 150px;">Bokningsnummer</th>
			<th style="width: 150px;">Summa</th>
			<th style="width: 150px;">Betald</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($guests as $g){ ?>
		<tr>
			<td><?php echo $g['firstname']; ?></td>
			<td><?php echo $g['lastname']; ?></td>
			<td><?php echo $g['num_ceremony']; ?></td>
			<td><?php echo $g['num_banquet']; ?></td>
			<td><a href="/admin/guest/party/<?php echo $g['id']; ?>"><?php echo $g['booking_no']; ?></a></td>
			<td><?php echo $g['sum']; ?></td>
			<td style="background-color: <?php echo ($g['paid'] == 1) ? "#80E880" : "#ff6e70"; ?>;"><?php echo ($g['paid'] == 1) ? "Ja" : "Nej"; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>