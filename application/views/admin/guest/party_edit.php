<h1>Sällskap</h1>
<p>
	<label for="guest['firstname']">Föramn:</label>
	<input type="text" name="guest['firstname']" value="<?php echo $guest['firstname'];?>">
	
	<label for="guest['lastname']">Efternamn:</label>
	<input type="text" name="guest['lastname']" value="<?php echo $guest['lastname']; ?>" /></p>
<p>
<p>
	<label for="unionmember">Är kårmedlem</label>
	<input type="checkbox" name="unionmember" value="1" <?php echo ($guest['union_member'] == 1) ? "checked='checked'" : ''; ?>/>
</p>
	<label for="guest['class']">Klass:</label>
	<input type="text" name="guest['class']" value="<?php echo $guest['class']; ?>" /></p>
</p>
	<label for="guest['email']">Epost:</label>
	<input type="text" name="guest['email']" value="<?php echo $guest['email']; ?>" /></p>
<p>
	<label for="guest['phone']">Telefonnummer:</label>
	<input type="text" name="guest['phone']" value="<?php echo $guest['phone']; ?>" /></p>
</p>
<p>
	<label for="guest['num_ceremony']">Antal till ceremonin:</label>
	<select name="num_ceremony">
		<?php for($i=0;$i<9;$i++){ ?>
			<option value="<?php echo $i; ?>" <?php echo ($i==$guest['num_ceremony']) ? 'selected' : ''; ?>><?php echo $i; ?></option>
		<?php } ?>
	</select>
</p>
<p>
	<label for="guest['num_banquet']">Antal till banketten:</label>
	<select name="num_banquet">
		<?php for($i=0;$i<9;$i++){ ?>
			<option value="<?php echo $i; ?>" <?php echo ($i==$guest['num_banquet']) ? 'selected' : ''; ?>><?php echo $i; ?></option>
		<?php } ?>
		</select>
</p>
<div style="float: left; clear: both;">
<p>Gästerna till banketten:
	<table>
		<thead>
			<tr>
				<th>Förnamn</th>
				<th>Efternamn</th>
				<th>Personnummer</th>
				<th>Allergi/Specialkost</th>
			</tr>
		</thead>
		<tbody>
			<?php for($i=0;$i<$guest['num_banquet'];$i++) { ?>
			<tr>
				<td><input type="text" style="width: 150px;" name="banquet[<?php echo $i; ?>][firstname]" value="<?php echo $party[$i]['firstname']; ?>" /></td>
				<td><input type="text" style="width: 150px;" name="banquet[<?php echo $i; ?>][lastname]" value="<?php echo  $party[$i]['lastname']; ?>" /></td>
				<td><input type="text" style="width: 150px;" name="banquet[<?php echo $i; ?>][ssn]" value="<?php echo $party[$i]['socialsecurity']; ?>" /></td>
				<td><input type="text" style="width: 150px;" name="banquet[<?php echo $i; ?>][allergy]" value="<?php echo $party[$i]['allergy']; ?>" /></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</p>
<p>
	Summa:	<?php echo $guest['sum']; ?> kr
</p>
<p>
	Betald:	<?php echo $guest['paid'] ? 'Ja' : 'Nej'; ?> 
	<a href="/admin/guest/<?php echo $guest['paid'] ? 'un' : ''; ?>pay/<? echo $guest['id']; ?>">
		<?php echo $guest['paid'] ? 'Gör Obetald' : 'Gör Betald'; ?>
	</a>
</p>

</div>