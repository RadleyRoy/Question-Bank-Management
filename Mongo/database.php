<?php

	
	// include library
	require "vendor/autoload.php";

	// creating connection
	$conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

	session_start();

	// creating or selection database
	$db=$conn->questionBank;

	$collection=$db->questions;

	$qtype = $_POST["customRadioInline1"];
	$qtitle = $_POST["qtitle"];
	$marks = (int)$_POST["marks"];
	$date = $_POST["date"];
	$question = $_POST["question"];
	$user = $_SESSION['user'];
	$option1 = $_POST["option1"];
	$option2 = $_POST["option2"];
	$option3 = $_POST["option3"];
	$option4 = $_POST["option4"];
	$answer = $_POST["customRadioInline2"];

	$doc = $collection->find();
	foreach ($doc as $d) {
		if($question == $d['question']){
			

			echo '<script type="text/javascript">';

			echo 'alert("Question is repeated");';
			echo 'window.location.href="Add.html";';
			echo '</script>';

			exit;
		}
	}

	$newdoc = array("qtype"=>$qtype, "qtitle"=>$qtitle, "marks"=>$marks, "date"=>$date, "user"=>$user, "question"=>$question, "option1"=>$option1, "option2"=>$option2, "option3"=>$option3, "option4"=>$option4, "answer"=>$answer);

	$collection->insertOne($newdoc);

	$collection=$db->daily;

	

	$check = $collection->count(array('date' => $date, 'user' => $user));
	if ($check == 0) {
		if ($qtype == "Quantitative") {
			$newdoc = array("date" => $date, "user" => $user, "Quantitative" => 1, "General Knowledge" => 0, "Logical" => 0,"Verbal" => 0, "Total" => 1);
		} 
		elseif ($qtype == "General Knowledge") {
			$newdoc = array("date" => $date, "user" => $user, "Quantitative" => 0, "General Knowledge" => 1, "Logical" => 0,"Verbal" => 0, "Total" => 1);
		}
		elseif ($qtype == "Logical") {
			$newdoc = array("date" => $date, "user" => $user, "Quantitative" => 0, "General Knowledge" => 0, "Logical" => 1,"Verbal" => 0, "Total" => 1);
		}
		elseif ($qtype == "Verbal") {
			$newdoc = array("date" => $date, "user" => $user, "Quantitative" => 0, "General Knowledge" => 0, "Logical" => 0,"Verbal" => 1, "Total" => 1);
		}
		$collection->insertOne($newdoc);
	} 
	else {
		$d = $collection->findOne(array("date" => $date, "user" => $user));
		$tot = (int) $d['Total'];
		$tot = $tot + 1;
		if ($qtype == "Quantitative") {
			$amt = (int) $d['Quantitative'];
			$amt = $amt + 1;
			$collection->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Quantitative' => $amt, 'Total' => $tot]]);
		} 
		elseif ($qtype == "General Knowledge") {
			$amt = (int) $d['General Knowledge'];
			$amt = $amt + 1;
			$collection->updateOne(['date' => $date, 'user' => $user], ['$set' => ['General Knowledge' => $amt, 'Total' => $tot]]);
		}
		elseif ($qtype == "Logical") {
			$amt = (int) $d['Logical'];
			$amt = $amt + 1;
			$collection->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Logical' => $amt, 'Total' => $tot]]);
		}
		elseif ($qtype == "Verbal") {
			$amt = (int) $d['Verbal'];
			$amt = $amt + 1;
			$collection->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Verbal' => $amt, 'Total' => $tot]]);
		}
	}
	

	header('Location: Add.html');
	exit;

?>