<h2>Info for  user "<?= $user->username; ?>"</h2>

<ul>
	<li>Email: <?= $user->email; ?></li>
	<li>Number of logins: <?= $user->logins; ?></li>
    <li>Userid: <?= $user->id; ?></li>
	<li>Last Login: <?= Date::fuzzy_span($user->last_login); ?></li>
    <ul>
        <?php foreach($user->get_user_roles() as $role){ ?>
        <li><b>[<?= $role['id']; ?>] <?= $role['name']; ?></b>: <?= $role['description']; ?></li>
        <?php } ?>
    </ul>
</ul>
<?php var_dump($user);?>

<?= HTML::anchor('user/logout', 'Logout'); ?>