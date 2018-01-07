<?php
/**
 * APNG class
 */

class APNG {
	public static function isFileSupported( File $file ) {
		return (
			$file->getMimeType() == 'image/png' &&
			$file->getHandler()->isAnimatedImage( $file )
		);
    }
    
    public static function ImageBeforeProduceHTML( $skin, $title, $file, &$frameParams, $handlerParams, $time, $res ) {
        if ( $file && self::isFileSupported( $file ) ) {
            if ( !isset($frameParams['class']) ) {
                $frameParams['class'] = 'apng';
            } else {
                $frameParams['class'] .= ' apng';
            }
        }
        return true;
    }

    public static function BeforePageDisplay( $out, $skin ) {
        $out->addModules( 'ext.apng' );
        return true;
    }
}