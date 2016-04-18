<?php
    session_unset();
    session_destroy();
    session_start();
    echo session_id();
?>

