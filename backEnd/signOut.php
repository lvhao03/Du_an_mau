<?php
    session_start();
    session_destroy();
    header('location: ../frontEnd/index.php');