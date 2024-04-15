<?php
require_once('../layouts/header.php');

$sm = AppManager::getSM();
$username = $sm->getAttribute("username");
$user_image = $sm->getAttribute("user_image");
$role = $sm->getAttribute("role");
$email = $sm->getAttribute("email");
$address = $sm->getAttribute("address");
$nic = $sm->getAttribute("nic");
?>

<div class="container">
    
</div>


<?php
require_once('../layouts/footer.php');
?>