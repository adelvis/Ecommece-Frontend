<?php


require_once "../controller/template.controller.php";
require_once "../model/template.model.php";


/**
 * 
 */
class AjaxTemplate 
{
	
	public function ajaxStyleTemplate()
	{
		# code...

		$answer = ControllerTemplate::ctrStyleTemplate();

		echo json_encode($answer);


	}
}

$object = new AjaxTemplate();
$object-> ajaxStyleTemplate();

