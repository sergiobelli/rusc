<?php

session_start();

echo "username=".$_SESSION['username'];
echo ",auth=".$_SESSION['auth'];
echo ",count=".$_SESSION['count'];

?>