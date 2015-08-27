<?
$content = Model::factory('dynamic')->get_content_by_name($dynamic);
?>
<? if(isset($edit) && $edit){ ?>
	<?=Form::open('/'.Request::current()->uri(), array('method' => 'post')); ?>
	<?=Form::textarea('ckedit', $content['content']); ?>
	<?=Form::submit('submit', 'Skicka'); ?>
	<?=Form::close(); ?>
	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		window.onload = function(){
		    CKEDITOR.replace( 'ckedit' );
		    CKEDITOR.config.height = 600;
		};
	</script>
	<script type="text/javascript">
	
	</script>
<? } else { ?>
	<? if(Auth::instance()->logged_in('admin')){ ?>
	<div style="float: right;">
		<a href="/<?=Request::current()->uri(); ?>/edit/">Edit</a>
	</div>
	<? } ?>
	<?=$content['content'];?>
<? } ?>
