<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Crop Image</title>
    <link rel='stylesheet' href='<?= base_url(); ?>plantilla/css/style.css' type='text/css' />
    <link rel='stylesheet' href='<?= base_url(); ?>plantilla/css/jquery.Jcrop.css' type='text/css' />
    <script src='<?= base_url() ?>plantilla/js/jquery.min.js'></script>
    <script src='<?= base_url() ?>plantilla/js/jquery.Jcrop.js'></script>
</head> 
 
<body>
    <?php echo form_open('croper/crop',"onsubmit='return checkCoords();'"); ?>
    <img style='margin:0 auto;' src='<?php echo base_url().'plantilla/uploads/gallery/'.$upload_data['raw_name'].'_thumb'.$upload_data['file_ext']; ?>' id='cropbox'>
    
    <!-- This is the form that our event handler fills -->
    
    <input type='hidden' id='x' name='x' />
    <input type='hidden' id='y' name='y' />
    <input type='hidden' id='w' name='w' />
    <input type='hidden' id='h' name='h' />
    <input type='hidden' id='source_image' name='source_image' value='<?php echo $source_image; ?>' />
    
    <button class='btn btn-block' type='submit'>Crop Image</button>
    
    <?php echo form_close(); ?>
    <script type='text/javascript'>
    
    $(function(){
    
    $('#cropbox').Jcrop({
        aspectRatio: 0,
        minSize: [ 227, 180 ],
        maxSize: [ 227, 180 ],
        onSelect: updateCoords
    });
    
    });
    
    function updateCoords(c)
    {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };
    
    function checkCoords()
    {
        if (parseInt($('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
    };
    </script>
</body>
</html>