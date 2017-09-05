<html>
    <head>
        <title><?=$this->e($title) ?></title>
    </head>
    <body>
        <?=$this->insert('menu', ['path' => $path])?>
        <?=$this->section('content')?>
    </body>
</html>