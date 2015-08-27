<h1>Sällskap</h1>
<p>Namn: <?php echo $guest['firstname'].' '.$guest['lastname']; ?></p>
<p>Klass: <?php echo $guest['class']; ?></p>
<p>Telefonnummer: <?php echo $guest['phone']; ?></p>
<p>Antal till ceremonin: <?php echo $guest['num_ceremony']; ?></p>
<p>Antal till banketten: <?php echo $guest['num_banquet']; ?></p>
<p>Summa: <?php echo $guest['sum']; ?> kr</p>
<p>Betald: <?php echo $guest['paid'] ? 'Ja' : 'Nej'; ?> 
	<a href="/admin/guest/<?php echo $guest['paid'] ? 'un' : ''; ?>pay/<? echo $guest['id']; ?>">
		<?php echo $guest['paid'] ? 'Gör Obetald' : 'Gör Betald'; ?>
	</a>
</p>
<p>Gästerna till banketten:
	<table>
		<thead>
			<tr>
				<th style="width: 150px;">Förnamn</th>
				<th style="width: 150px;">Efternamn</th>
				<th style="width: 150px;">Personnummer</th>
				<th style="width: 150px;">Allergi/Specialkost</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($party as $g) { ?>
			<tr>
				<td><?php echo $g['firstname']; ?></td>
				<td><?php echo $g['lastname']; ?></td>
				<td><?php echo $g['socialsecurity']; ?></td>
				<td><?php echo $g['allergy']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</p>