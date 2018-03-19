<?php
class Admin{
	public $id;
	public $links = array('Passpapers'=>'passpaper.php', 'HomeWorks' => 'homeworks.php', 'Assignments' => 'assignment.php', 'Register Exams' => 'register.php', 'Recorrection' => 'recorrection.php', 'QUIZ' => 'quiz_home.php', 'Result' => 'resultsview.php?results=show');
	function __construct($id){
		$this->id = $id;
	}
}
?>