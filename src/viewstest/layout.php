<html>
<head>
    <title><?=$this->e($title)?></title>
    
</head>
<body>
<?=$this->insert('menu', ['name' => $this->e($zgeg)])?>
    
<?=$this->section('content')?>

</body>
</html>

