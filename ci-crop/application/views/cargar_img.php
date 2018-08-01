<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <article>
        <h2>Seleccionar imagen</h2>
        <?php 
        $attrib = array('name'=>'input_img','id'=>'input_img');
        echo form_open_multipart('imagenes/procesar_imagen',$attrib);?>
        
            <input type="file" name="userfile" id="userfile">
            <br>
            <input type="submit" name="subir" value="Subir Imagen">
        <?php echo form_close() ?>
    </article>
</body>
</html>