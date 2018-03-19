
<?php
include "frame.php";
require "Quiz.php";
require "QuestionCategory.php";
	$user = $_SESSION['user'];
	$id = strtolower($user->id);

class QuizSession{
	public $startedTime;
	public $duration;
	public $blowUpTime;
	public $quiz;
	public $questions;
	public $answers;
	public $sessionFlag;
	public $marks;
	
	public function __construct($quiz){
		$this->startedTime = time(); //current time
		$this->duration = $quiz -> duration;
		$this->blowUpTime = $quiz -> ends;
		$this->quiz = $quiz;
		$this->questions = $quiz -> questions;
		$this->sessionFlag = TRUE;
		$this -> marks = 0;
	}
	
	public function terminateSession(){
		$this ->markQuestions();
		$this -> sessionFlag = FALSE;
	}
	
	public function answerQ($qIndex, $ansIndex){
		$this -> questions[$qIndex][3] = $ansIndex;
	}
	
	public function markQuestions(){
		if($this ->sessionFlag){
			foreach($this -> questions as $key => $question){
				$ans = end($question);
				$cAns = prev($question);
				if($ans == $cAns){
					$this -> marks ++;
				}
			}
		}
	}
}
?>
<html>
<main>
<h3>Have a nice day <?php echo strtoupper($id) ?></h3>
<?php
	$students = array(); //need to be from db or main page.
	$lectures = array();
	$quizs = array();
	$qCategories = array();  //will be eretrieved from db

function createQCategory($name){
	global $qCategories;
	$qCategories[$name] = new QuestionCategory($name);
}

function removeQCategory($name){
	global $qCategories;
	unset($qCategories[$name]);
}

function createQuiz($name, $start, $ends, $duration){
	global $quizs;
	$quizs[$name] = new Quiz($name, $start, $ends, $duration);
}

function removeQuiz($name){
	global $quizs;
	unset($quizs[$name]);
}

function viewQuizs(){
	foreach($quizs as $quiz){
		//sql querry to store marks goes here.
		echo 'Your Score is:'.$quiz -> name."<br>";
	}
}

function attemptQuiz($quiz){
	global $id, $session, $quizs;
	$quiz = $quizs[$quiz];
	if(in_array($id, $quiz -> participants)){
		$session = new QuizSession($quiz);
		$_SESSION['session'] = $session;
		$_SESSION['quiz'] = $quiz;
		echo $quiz -> printQs();
		echo '<form method="get" action="quiz_home.php?submit=\"TRUE\""><button type="submit" name="submit" value="TRUE">Submit all and finish</button></form>';
		$session->answerQ(0,3);
	}
}

function submitQuiz(){
	$session = $_SESSION['session'];
	$session -> terminateSession();
	echo $session -> marks;
	//unset($sessions[$id]);
}


if(!isset($_SESSION['id'])){
	$id = 3;
	$students = array(5,3,2);
	createQCategory("test");
	$qCategories["test"]->addQ("Question 1", array("Ans1", "ans2", "ans3", "ans4"), 3);
	createQuiz("Quiz 1", 0, 0, 60);
	$quizs["Quiz 1"] -> addParticipants(array(3,4,8,9));
	$qCategories["test"]->selectQ(0);
	$quizs["Quiz 1"]->addQs($qCategories["test"]->selectedQs);
}


if(isset($_GET['quiz'])){	attemptQuiz($_GET['quiz']);	}
if(isset($_GET['submit'])){	submitQuiz();	}

if(in_array($id, $students)&&!isset($_GET['quiz'])){
	foreach($quizs as $qname => $quiz){
		if(in_array($id, $quiz -> participants)){
			echo '<form method="post" action="quiz_home.php?quiz='.$quiz->name.'">'.$quiz->name.'&nbsp;&nbsp;<input type="submit" value="Attempt Now" /></form>';
		}
	}
}
elseif(in_array($id, $lectures))
?>
</main>
</html>