<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require '../src/Csrf.php';
use thanhtaivtt\CSRF\CSRF;
$csrf = new CSRF;
if (!$csrf->validate()) {
    echo 'method not allow';
};
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>form</title>
</head>
<body>
    <form action="" method="post" accept-charset="utf-8">
        <?php $csrf->tokenField(); ?>
       <input type="text" name="fds">
       <input type="submit" name="s" value="sub">
    </form>
</body>
</html>
