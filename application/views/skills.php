<?php
echo Form::open('/skills/update/', array('method' => 'post'));
 foreach($skills as $s){
    echo Form::label('skill['.$s['sid'].']', $s['name'])
        .Form::checkbox('skill[]', $s['sid'], isset($userskills[$s['sid']]));


}
echo Form::submit('update', 'Uppdatera').Form::close();
?>