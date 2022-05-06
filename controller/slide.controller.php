<?php

/**
 * Controller Slider
 */
class ControllerSlider 
{
	
	static public function ctlViewSlide()
	{
		# code...

		$table = "slide";

		$answer = ModelSlide::mdlViewSlide($table);


		return $answer;


	}
}