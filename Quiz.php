<?php

class Quiz{
	public $name;
	public $start;
	public $ends;
	public $duration;
	public $questions;
	public $participants;
	
	public function __construct($name, $start, $ends, $duration){
		$this->name = $name;
		$this->questions = array();
		$this->participants = array();
	}
	
	public function addQs($questions){
		$this -> questions = array_merge($this -> questions, $questions);
	}
	
	public function schedule(){
		//mysql querry goes here
	}
	
	public function addParticipants($participants){
		$this -> participants = $participants;
	}
	
	public function printQs(){
		$quiztxt='';
		for($i = 0; $i < sizeof($this -> questions); $i++){
			$qs = $this -> questions[$i];
		$quiztxt = $quiztxt.'<div class ="questions">'.($i+1).". ".$qs[0].'<br></div><div class="answers"><form method ="GET" action="">';
			foreach($qs[1] as $key => $ans){
				$quiztxt = $quiztxt.'<input type="radio" name="'.$i.'"value="'.$key.'">'.$ans.'<br>';
			}
			$quiztxt = $quiztxt.'</form></div>';
		}
		return $quiztxt;
	}
}

?>