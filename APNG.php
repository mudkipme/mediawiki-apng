<?php
/**
 * APNG extension - Enables animated PNG support on MediaWiki on unsupported browsers.
 *
 * @file
 * @ingroup Extensions
 */

if ( function_exists( 'wfLoadExtension' ) ) {
    wfLoadExtension( 'APNG' );
    $wgMessagesDirs['APNG'] = __DIR__ . '/i18n';
    wfWarn(
        'Deprecated PHP entry point used for the APNG extension. ' .
        'Please use wfLoadExtension instead, ' .
        'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
    );
    return;
} else {
    die( 'This version of the APNG extension requires MediaWiki 1.25+' );
}