<?php
/**
 * APNG extension - Enables animated PNG support in Webkit browsers and Internet Explorer 10
 *
 * @file
 * @ingroup Extensions
 */

if ( !defined( 'MEDIAWIKI' ) ) { die(); }

// credits
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'APNG',
	'version' => '0.1.2',
	'author' => array( 'David Mzareulyan', 'Mudkip' ),
	'url' => 'https://github.com/mudkipme/mediawiki-apng',
	'descriptionmsg'  => 'apng-desc',
);

$wgExtensionMessagesFiles['APNG'] = dirname( __FILE__ ) . '/APNG.i18n.php';

$wgResourceModules['ext.apng'] = array(
	'scripts' => array('udeferred.js', 'crc32.js', 'apng-canvas.js', 'apng-loader.js' ),
	'localBasePath' => dirname( __FILE__ ) . '/modules',
	'remoteExtPath' => 'APNG/modules',
	'targets' => array( 'desktop', 'mobile' ),
);

class APNG {
	public static function isFileSupported( File $file ) {
		return (
			$file->getMimeType() == 'image/png' &&
			$file->getHandler()->isAnimatedImage( $file )
		);
	}
}

$wgHooks['ImageBeforeProduceHTML'][] = function($skin, $title, $file, &$frameParams, $handlerParams, $time, $res){
	if ( $file && APNG::isFileSupported( $file ) ) {
		if ( !isset($frameParams['class']) ) {
			$frameParams['class'] = 'apng';
		} else {
			$frameParams['class'] .= ' apng';
		}
	}
	return true;
};

$wgHooks['ImageOpenShowImageInlineBefore'][] = function ( $imagePage, $output ) {
	$file = $imagePage->getDisplayedFile();
	if ( $file && APNG::isFileSupported( $file ) ) {
		$output->addModules( 'ext.apng' );
	}
	return true;
};
