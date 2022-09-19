<?php 
session_start();
require_once('DB.php');
require_once('filters.php');
require_once('classes/Helper.php');
require_once('classes/User.php');
require_once('classes/Blog.php');

if( ! User::is_logged() ):
    die('You don\'t have access to this page');
endif;