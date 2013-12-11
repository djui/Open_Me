<?PHP


fix('3_d.png','3_3.png');



function fix($from,$to) {

	$im = imagecreatefrompng($from);

	#imagefilter($im, IMG_FILTER_GRAYSCALE);
	imagefilter($im, IMG_FILTER_CONTRAST, -100);
	#imagefilter($im, IMG_FILTER_CONTRAST, -1000);
	imagetruecolortopalette($im,false, 255);
	imagepurebw($im);
	imagepng($im, $to);
	imagedestroy($im);


}


function imagepurebw( $im, $amount = 685 ) {
    $total = imagecolorstotal( $im );
    for ( $i = 0; $i < $total; $i++ ) {
        $index = imagecolorsforindex( $im, $i );
        array_pop( $index );
        $color = ( array_sum( $index ) > $amount ) ? 255 : 0;
        imagecolorset( $im, $i, $color, $color, $color );
    }
}


?>