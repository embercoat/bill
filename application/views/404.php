<h1><?= __('An Error Ocurred'); ?></h1>
<?= __('Either you clicked on a link that no longer exists or those bloody admins messed up again. Either way, it should be fixed momentarily'); ?>

<?php if(Auth::instance()->get_user()->has_role('admin')){ ?>
<h2>Hey! You're admin! I can tell you stuff!</h2>
Okay, so here's the deal: Some dude(ette?) created a link here without creating the proper responses.
<br /><br />
He either meant to create a dynamic page that gets its text from the database, <a href="/<?=Request::current()->uri(); ?>/edit/">click here to create one</a>, 
or he meant to create a function to do some pretty cool stuff. If the latter is the probable case then you need to create the function <em>action_<?php echo (!empty($arg1) ? $arg1 : 'index');?></em> in the controller <em><?php echo Request::$current->controller(); ?></em>.<br /><br />
If you do not know how to do this i suggest you contact the IT-guy. Specify your problem, what do you want to accomplish, not what you want to do.

<?php } ?>