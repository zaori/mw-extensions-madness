<?php
/**
 * Madness extension - A parser-function to query the Madness
 *
 * @file
 * @ingroup Extensions
 * @version 1.0
 * @author Calimonius the Estrange
 * @date 2013
 * @licence GNU General Public Licence 2.0 or later
 */

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'Madness' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['Madness'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['Madness'] = __DIR__ . '/Madness.alias.php';
	wfWarn(
		'Deprecated PHP entry point used for Madness extension. Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the Madness extension requires MediaWiki 1.25+' );
}
