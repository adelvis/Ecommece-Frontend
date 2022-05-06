<?php
	session_start();
	require_once "controller/template.controller.php";
	require_once "controller/product.controller.php";
	require_once "controller/slide.controller.php";
	require_once "controller/user.controller.php";
	require_once "controller/cart.controller.php";
	require_once "controller/visits.controller.php";
	require_once "controller/notifications.controller.php";


	require_once "model/template.model.php";
	require_once "model/product.model.php";
	require_once "model/route.php";
	require_once "model/slide.model.php";
	require_once "model/user.model.php";
	require_once "model/cart.model.php";
	require_once "model/visits.model.php";
	require_once "model/notifications.model.php";

	require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
	require_once "extensiones/vendor/autoload.php";

	$template = new ControllerTemplate();
	$template-> template();


