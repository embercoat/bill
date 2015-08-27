<h1>Status</h1>
<?php
if(isset($messages['error']))
foreach($messages['error'] as $e){ ?>
<p class="error"><?php echo $e; ?></p>
<?php } ?>
<?php
if(isset($messages['green']))
foreach($messages['green'] as $g){ ?>
<p class="green"><?php echo $g; ?></p>
<?php } ?>
