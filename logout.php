<?php

include_once './includes/autoloader.php';



Auth::logout();



header("Location: blog.php");