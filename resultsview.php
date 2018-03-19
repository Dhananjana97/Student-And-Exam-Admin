<?php include 'frame.php'?>
<html>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 8px 20px;
    text-align: left;
}
.inlink a{
	text-decoration: none;
    font-size: 22px;
	padding: 8px 35px;
    display: block;
	text-align: center;
	float:left;
}
</style>
<main>
<div class="inlink"><center><a href="?results=show">View Results</a>&nbsp;<a href="?overallGPA=show">View Overall GPA</a></center><br></div>
<?php
	$user = $_SESSION['user'];
	$mydb = mysqli_connect("localhost", "root", "", "sea") or die("Something wrong with the server, try again later.");
	$id = $user->id;
	$results = mysqli_query($mydb, "SELECT * FROM RESULTS WHERE id = '$id'");
	$gpa_chart = mysqli_query($mydb, "SELECT * FROM GPA_CHART");
	
	$module_credit = mysqli_query($mydb, "SELECT * FROM Modules");

	$result_column = mysqli_fetch_fields($results);
	$result_row = mysqli_fetch_row($results);
	if(isset($_GET['results'])&&$_GET['results']=="show"){
		
		echo '<center><table>';
		foreach ($result_row as $key => $field){
			echo '<tr><td style="width:300px">'.strtoupper($result_column[$key]->name).'</td>'.'<td><center>'.$field.'</center></td></tr>';
			echo '<br>';
		}
		echo '</table></center>';
	}
	
	if(isset($_GET['overallGPA'])&&$_GET['overallGPA']=="show"){
		$gpalist = array();
		while($row = $gpa_chart->fetch_assoc()){
			$gpalist[$row['GRADE']] = $row['GPA'];
		}
		
		$credits = array();
		while($row = mysqli_fetch_row($module_credit)){
			$credits[$row[0]] = $row[1];
		}
	
		$GPA = 0;
		$credit = 0;
		for($i=1; $i<count($result_row); $i++){
			$cur_credit = $credits[strtoupper($result_column[$i]->name)];
			$GPA += $gpalist[$result_row[$i]]*$cur_credit;
			$credit += $cur_credit;
		}
		echo '<br><br><center><text style="font-size:20px; font-weight: bold">You Current Overall GPA:  '.$GPA/$credit.'</text></center>';
	}
?>

</main>
</html>