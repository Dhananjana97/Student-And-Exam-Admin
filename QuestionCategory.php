<?php
class QuestionCategory{
	public $name;
	public $questions;
	public $selectedQs;
	public function __construct($name){
		$this -> name = $name;
		$this->questions = array();
		$this->selectedQs = array();
	}

	public function addQ($question, $answers, $correct){
		$this -> questions[] = array($question, $answers, $correct, NULL);
	}

	public function removeQ($index){
		unset($this->questions[$index]);
		$this->questions = array_values($questions);
	}

	public function selectQ($index){
		$this->selectedQs[$index] = $this->questions[$index];
	}

	public function deselectQ($index){
		unset($this->selectedQs[$index]);
	}
}
?>