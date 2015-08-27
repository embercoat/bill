<?php
echo Form::open('/user/changepassword/')
    .Form::label('oldpassword', 'Gamla lösenordet')
    .Form::password('oldpassword')
    .Form::label('newpassword', 'Nytt lösenord')
    .Form::password('newpassword')
    .Form::label('newpasswordrepeat', 'En gång till')
    .Form::password('newpasswordrepeat')
    .Form::submit('submit','Byt Lösenord')
    .Form::close();

if(isset($message))
    echo '<p style="clear:both;">'.$message.'</p>';
?>
