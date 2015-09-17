<?php

class MadnessHooks {

	/**
	* @param $parser Parser
	* @return bool
	*/
	function wfRegisterMadness( $parser ) {
		$parser->setFunctionHook( 'madness', 'ExtMadness::madness' );
		return true;
	}
}
