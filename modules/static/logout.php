<?php

setcookie('id', '' , time() - 3600*24*30*12, '/');
setcookie('hash', '' , time() - 3600*24*30*12, '/');
session_unset();
session_destroy();

header('Location: /');
exit();