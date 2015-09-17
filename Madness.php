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

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Madness',
	'version' => '0.3.squid',
	'author' => array( 'Calimonius the Estrange' ),
	'descriptionmsg' => 'madness-desc',
);

$wgAutoloadClasses['ExtMadness'] = dirname( __FILE__ ) . '/Madness.body.php';
$wgExtensionMessagesFiles['Madness'] = dirname( __FILE__ ) . '/Madness.i18n.php';
$wgExtensionMessagesFiles['MadnessMagic'] = dirname( __FILE__ ) . '/' . 'Madness.i18n.magic.php';

$wgHooks['ParserFirstCallInit'][] = 'wfRegisterMadness';

/**
 * @param $parser Parser
 * @return bool
 */
function wfRegisterMadness( $parser ) {
	$parser->setFunctionHook( 'madness', 'ExtMadness::madness' );
	return true;
}
