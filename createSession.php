<?php

    session_start();
    $_SESSION['this_seesion_id'] = hash("md5",session_id()."+".$_POST['this_seesion_id']);
    echo  $_SESSION["this_seesion_id"];
?>

