<?php

include __DIR__ . '/config.php';
include __DIR__ . '/helpers/AppManager.php';

require_once __DIR__ . '/models/User.php';

$userModel = new User();

if ($userModel->addUser("pooja","kalpity","0234569871","985263914V","admin","pooja@gmail.com","pooja123")) {
    echo "User created successfully";
} else {
    echo "Failed to create user. May be user already exist!";
}
// if ($userModel->addUser("sam","puttalam","0123456789","971234567V","member","sam@gmail.com","sam123")) {
//     echo "User created successfully";
// } else {
//     echo "Failed to create user. May be user already exist!";
// }