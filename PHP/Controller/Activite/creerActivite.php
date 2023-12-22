<?php
include("../../Model/checkSession/checkSession.php");
checkMailAdmin();
checkMailOrga();
require_once '../../View/Activite/creerActivite.php';