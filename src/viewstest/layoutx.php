<html>
<head>
    <title><?=$this->e($title)?></title>
    
</head>
<body>
<?=$this->insert('menu', ['name' => $this->e($test)])?>
    
<?=$this->section('content')?>

</body>
</html>

