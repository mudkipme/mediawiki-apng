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
	'version' => '0.1.1',
	'author' => array( 'David Mzareulyan', 'Mudkip' ),
	'url' => 'https://github.com/mudkipme/mediawiki-apng',
	'descriptionmsg'  => 'apng-desc',
);

$wgExtensionMessagesFiles['APNG'] = dirname( __FILE__ ) . '/APNG.i18n.php';

$wgResourceModules['ext.apng'] = array(
	'scripts' => array('udeferred.js', 'crc32.js', 'apng-canvas.js', 'apng-loader.js' ),
	'localBasePath' => dirname( __FILE__ ) . '/modules',
	'remoteExtPath' => 'APNG/modules'
);

$wgHooks['ImageBeforeProduceHTML'][] = function($skin, $title, $file, &$frameParams, $handlerParams, $time, $res){
	if ( $file ) {
		$metadata = @unserialize($file->getMetadata());
		$mimetype = $file->getMimeType();
		if ( $mimetype == 'image/png' && isset($metadata['frameCount']) && $metadata['frameCount'] > 1 ) {
			if ( !isset($frameParams['class']) ) {
				$frameParams['class'] = 'apng';
			} else {
				$frameParams['class'] .= ' apng';
			}
		}
	}
	return true;
};

$wgHooks['BeforePageDisplay'][] = function($out, $skin){
	$out->addModules( 'ext.apng' );
	return true;
};
