<?php

echo Form::open('/ad/create')

    .Form::hidden('ad_id', $ad_id)

    .Form::label('title', 'Titel')
    .Form::input('title')

    .Form::label('description', 'Beskrivning')
    .Form::textarea('description')

    .Form::label('images', 'Bilder')
    .Form::file('images', array('multiple', 'accept' => 'image/*', 'capture'));


?>
<div id="imagelist">
    <div id="imagelist_title">Dina bilder</div>
    <div id="imagelist_empty" class="image_row">Här var det tomt..</div>
</div>
<?
    echo Form::submit('', 'Skapa!')
        .Form::close();
?>
<script type="text/javascript">
    function readMultipleFiles(evt) {
        var files = evt.target.files;
        if (files) {
            for (var i=0, f; f=files[i]; i++) {
                console.log(f);
                var r = new FileReader();
                r.onload = (function(f) {
                    return function(e) {
                        var contents = e.target.result;

                        $.post('/api/upload/imageToAd?ad='+$('#ad_id').val() , {'filename' : f.name, 'imagedata' : contents, 'ad_id' : $('#ad_id').val(), 'type' : 0})
                        .done(function(data){
                            data = $.parseJSON(data);
                            $('#imagelist_empty').hide();
                            $('#imagelist').append(
                                '<div class="image_row" id="image_row_'+ data.image_id +'">' +
                                    '<div class="image_name">' + data.filename + '</div>' +
                                    '<div class="image"><img src="/media/image/'+data.image_id+'/'+data.filename+'/?width=100" /></div>' +
                                    '<button type="button" class="remove_image" onclick="javascript:remove_image('+data.image_id+')">Ta bort</button>' +
                                '</div>'
                            )
                        });
                    };
                })(f);
                r.readAsDataURL(f);
            }
        } else {
            alert("Failed to load files");
        }
    }
    function remove_image(imageid){
        $.get('/api/media/delete/'+imageid)
            .success(function(data){
                $("#image_row_"+imageid).remove();
            })
            .fail(function(data){
                switch(data.status){
                    case 403:{
                        alert("Unauthorized");
                        break;
                    }
                }

            })
            ;
    }

    document.getElementById('images').addEventListener('change', readMultipleFiles, false);
</script>