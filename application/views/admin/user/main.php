<table>
	<thead>
		<tr>
			<th style="width: 100px;">Förnamn</th>
			<th style="width: 100px;">Efternamn</th>
			<th style="width: 100px;">Användarnamn</th>
			<th style="width: 100px;">Epost</th>
			<th style="width: 100px;">Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$alternator = 0;
			foreach($users as $user){
		?>
		<tr <?=(++$alternator%2 == 0) ? 'style="background-color: silver"' : '' ?>>
			<td><?php echo $user['firstname']; ?></td>
			<td><?php echo $user['lastname']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><a href="/admin/user/detail/<?php echo $user['id']; ?>/">Details</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>