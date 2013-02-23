<?php require_once('VimeoSimpleAPI.php'); ?>

<!DOCTYPE html>
<html>
<head>
<title>Vimeo Simple API PHP wrapper class</title>
<meta charset="utf-8" />
</head>

<body>

<?php
$vimeoAPI = new VimeoSimpleAPI('gabrieleromanato', 'videos', 'json');
print_r($vimeoAPI->getData());

?>

</body>
</html>