<?php
/*
	S. M. Mehedi Hasan
	www.mehedi.com.bd
*/

// Image Directory & Generate Image Location
$imgDir = 's-img/';
$imgPath = $imgDir.base64_decode($_GET['src']);

// Load PNG Watermark
$stamp = imagecreatefrompng('watermark.png');

// Load JPG File & Calculate Size to Put Watermark
$im = imagecreatefromjpeg($imgPath); 
list($width, $height) = getimagesize($imgPath);
list($swidth, $sheight) = getimagesize('watermark.png');
$marge_right = ($width-$swidth)/2;
$marge_bottom = ($height-$sheight)/2;;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Generate New JPG File
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Output Watermarked JPEG File
header('Content-type: image/jpeg');
imagepng($im);
imagedestroy($im);
?>