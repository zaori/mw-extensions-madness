<?php

class ExtMadness {

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

	static function formatList() {

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

		# Random line
		if ( $textID == '' || $textID == 'random' ) {
			$res = $dbr->selectField(
				'line',
				'line_text',
				'',
				__METHOD__,
				array( 'ORDER BY' => 'rand()' )
			);
			$text = $res;
		}
		# Specific line
		elseif ( is_numeric( $textID ) ) {
			$res = $dbr->selectField(
				'line',
				'line_text',
				"line_id = $textID",
				__METHOD__
			);
			$text = $res;
		}
		# List
		elseif ( $textID == 'all' ) {
			$format = $search1;
			$text = '';

			$res = $dbr->select(
				'line',
				'line_text',
				'',
				__METHOD__
			);/*
			if ( $format == '' || $format == 'list' ) {
				foreach ( $res as $row ) {
					$text .= '*' . utf8_decode( $row->line_text ) . "\n";
				}
			}
			elseif ( $format == 'paragraph' ) {
				foreach ( $res as $row ) {
					$text .= '\n' . utf8_decode( $row->line_text ) . '\n';
				}
			}
			elseif ( $format == 'inline' ) {
				foreach ( $res as $row ) {
					$text .= utf8_decode( $row->line_text ) . ' ';
				}
			}*/
			foreach ( $res as $row ) {
				$text .= '*' . $row->line_text . "\n";
			}
		}/*
		# List
		elseif ( $textID == 'search' ) {
			# Rename variables accordingly
			$searchKey = $search1;
			$format = $search2;

		}*/
		else {
			$text = 'Improper query.';
		}

		$dbr->close();
		return $text;
	}
}
