<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8, IE=9, IE=10">
    <link rel="stylesheet" type="text/css" href="components/assets/css/main.css">
</head>
<body style="padding-top: 0;">

    <div class="container">

        <h1><?php echo $this->_tpl_vars['Viewer']->GetCaption(); ?>
</h1>

        <?php echo $this->_tpl_vars['Viewer']->GetValue($this->_tpl_vars['Renderer']); ?>


    </div>

</body>
</html>