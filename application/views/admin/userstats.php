<table>
<thead>
    <tr><th>Skills</th><?php foreach($users as $u) echo '<th>'.$u['fname'].' '.$u['lname'].'</th>'; ?></tr>
</thead>
<tbody>
    <?php foreach($skills as $s){ ?>
    <tr>
        <td><?php echo $s['name'];?></td>
    <?php foreach($users as $u) {?>
        <td class="<?php echo isset($userskills[$u['user_id']][$s['sid']]) ? 'green': 'red'; ?>">
            <?php echo isset($userskills[$u['user_id']][$s['sid']]) ? 'Ja': 'Nej'; ?></td>
    <?php } ?>
    </tr>
    <?php } ?>
</tbody>
</table>