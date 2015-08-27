<table>
<thead>
	<tr>
		<td style="width: 200px;">Page</td>
		<td style="width: 250px;">Last modified</td>
		<td style="width: 100px;">Modified by</td>
		<td style="width: 100px;">Modify</td>
	</tr>
</thead>
<tbody>
<?php 
$alternator = 0;
foreach($dynamics as $d){
?>
    <tr <?=(++$alternator%2 == 0) ? 'style="background-color: silver"' : '' ?>>
    	<td><?=$d['name'];?></td>
    	<td><?=date('j F Y h:i:s', $d['edited']);?></td>
    	<td><?=user::get_username_by_id($d['editor']);?></td>
    	<td>
    		<a href="/<?=str_replace('.', '/', $d['name']);?>/edit/">Edit</a>
    		<a href="/admin/dynamic/delete/<?php echo str_replace('.', '_', $d['name']); ?>/">Delete</a>
    	</td>
   	</tr>
<?
}

?>
</tbody>
</table>