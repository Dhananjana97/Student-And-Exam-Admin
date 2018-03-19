<?php
class Lecturer{
	public $id;
	public $links = array('SetQuiz'=>'Quiz_home.php', 'Set_HomeWorks' => 'homeworks.php', 'Assignments' => 'assignment.php', 'Register Exams' => 'register.php', 'Recorrection' => 'recorrection.php', 'QUIZ' => 'quiz_home.php', 'Result' => 'resultsview.php?results=show');
	function __construct($id){
		$this->id = $id;
	}
}
?>