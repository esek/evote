<?php
class Evote {

	/**
	Returns the election id. If there is no ongoing election it returns NULL.
	@return 	electionId | NULL
	*/	
	public function getElectionId(){
		return 1;
	}
	/*
	Tells if there is a ongoing round
	@return 	TRUE | FALSE
	*/
	public function ongoingRound(){
		return FALSE;
	}





}
?>
