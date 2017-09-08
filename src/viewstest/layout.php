<html>
    <head>
        <title><?=$this->e($title) ?></title>
    </head>
    <body>
        <?=$this->insert('menu', ['path' => $path, 'session' => $session])?>
        <?=$this->insert('flash.html', ['flashMsg' => $session->getFlashMsg()])?>
        <?=$this->section('content')?>
    </body>
</html>