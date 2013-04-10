<?php

	function generateCode($characters) {
	
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible 	= '0123456789';
		$code 		= '';
		$i 			= 0;
		
		while ($i < $characters) {
		 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
			
		}
		return $code;
		
	}

	function CaptchaSecurityImages($width='120',$height='40',$characters='6') {
	
		$code 	= generateCode($characters);
		$CI		= &get_instance();
		
		$CI->session->set_userdata("code",$code);
		
		/* font size will be 75% of the image height */
		$font_size 	= $height * 0.8;
		$image 		= @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		
		/* set the colours */
		$background_color 	= imagecolorallocate($image, 255, 255, 255);
		$text_color 		= imagecolorallocate($image, 20, 40, 100);
		$noise_color 		= imagecolorallocate($image, 100, 120, 180);
		
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		
		/* create textbox and add text */
		$textbox 	= imagettfbbox($font_size, 0, './captcha/monofont.ttf', $code) or die('Error in imagettfbbox function');
		$x 			= ($width - $textbox[4])/2;
		$y 			= ($height - $textbox[5])/2;
		
		imagettftext($image, $font_size, 0, $x, $y, $text_color, './captcha/monofont.ttf' , $code) or die('Error in imagettftext function');
		
		//header('Content-Type: image/jpeg');
		imagejpeg($image,"./images/code.jpg");
		imagedestroy($image);
		
		echo '<img src="'.base_url().'images/code.jpg" />';
		
	}
?>