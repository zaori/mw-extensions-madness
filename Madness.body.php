<?php

class ExtMadness {

	/**
	* @param $parser Parser
	* @return bool
	*/
	static function onParserFirstCallInit( $parser ) {
		$parser->setFunctionHook( 'madness', 'ExtMadness::madness' );
		return true;
	}

	/**
	 * Since it's a different database, create an object for it
	 * @return DatabaseBase
	 */
	public static function setupDB( $server, $user, $password, $database) {

		$dbr = DatabaseBase::factory (
			'mysql',
			array(
				'host' => $server,
				'user' => $user,
				'password' => $password,
				'dbname' => $database
			)
		);
		return $dbr;
	}

	/**
	 * @param $parser Parser
	 * @param $textID string input
	 * @param $search1 string input
	 * @param $search2 string input
	 * @return string
	 */
	public static function madness( $parser, $textID = '', $search1 = '', $search2 = 'list' ) {
		global $wgMadnessServer, $wgMadnessDB, $wgMadnessUser, $wgMadnessPassword;
		$dbr = self::setupDB( $wgMadnessServer, $wgMadnessUser, $wgMadnessPassword, $wgMadnessDB );

		// Random line
		if ( $textID == '' || $textID == 'random' ) {
			$res = $dbr->selectField(
				'line',
				'line_text',
				'',
				__METHOD__,
				array( 'ORDER BY' => 'rand()' )
			);
			$text = $res;
		} elseif ( is_numeric( $textID ) ) { // Specific line
			$res = $dbr->selectField(
				'line',
				'line_text',
				array( 'line_id' => $textID ),
				__METHOD__
			);
			$text = $res;
		} elseif ( $textID == 'all' ) { // List
			$format = $search1;
			$text = '';

			$res = $dbr->select(
				'line',
				'line_text',
				'',
				__METHOD__
			);
			foreach ( $res as $row ) {
				$text .= '*' . $row->line_text . "\n";
			}
		} else {
			$text = wfMessage( 'madness-input-error' )->text();
		}

		return $text;
	}
}
