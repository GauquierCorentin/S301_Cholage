<?php
include "../../Model/BarreMenu/BarreMenu.php";
rechargerSession($_SESSION["mail"]);
include ("../../View/BarreMenu/BarreMenu.php");