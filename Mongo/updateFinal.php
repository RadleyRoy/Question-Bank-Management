<?php

	
	// include library
	require "vendor/autoload.php";

	// creating connection
	$conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

	session_start();

	// creating or selection database
	$db=$conn->questionBank;

	$collection=$db->questions;

	$docs = $collection->find();


		$uqtype = $_POST["update"];
		$uquestion = $_POST["question"];

		if (isset($_POST['info'])) {
			$date = $_POST["date"];
			$user = $_POST["user"];
			$info = $_POST["info"];
			$do = $collection->findOne(array('question'=>$uquestion));
			$past = $do['qtype'];
			$collection->updateOne(['question' => $uquestion], ['$set' => ['qtype' => $info]]);
			$coll=$db->daily;
			$d = $coll->findOne(array("date" => $date, "user" => $user));
			if ($past == "Quantitative") {
				$amt = (int) $d['Quantitative'];
				$amt = $amt - 1;
				$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Quantitative' => $amt]]);
			} 
			elseif ($past == "General Knowledge") {
				$amt = (int) $d['General Knowledge'];
				$amt = $amt - 1;
				$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['General Knowledge' => $amt]]);
			}
			elseif ($past == "Logical") {
				$amt = (int) $d['Logical'];
				$amt = $amt - 1;
				$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Logical' => $amt]]);
			}
			elseif ($past == "Verbal") {
				$amt = (int) $d['Verbal'];
				$amt = $amt - 1;
				$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Verbal' => $amt]]);
			}
			if ($info == "Quantitative") {
			$amt = (int) $d['Quantitative'];
			$amt = $amt + 1;
			$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Quantitative' => $amt]]);
			} 
			elseif ($info == "General Knowledge") {
				$amt = (int) $d['General Knowledge'];
				$amt = $amt + 1;
				$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['General Knowledge' => $amt]]);
			}
			elseif ($info == "Logical") {
				$amt = (int) $d['Logical'];
				$amt = $amt + 1;
				$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Logical' => $amt]]);
			}
			elseif ($info == "Verbal") {
				$amt = (int) $d['Verbal'];
				$amt = $amt + 1;
				$coll->updateOne(['date' => $date, 'user' => $user], ['$set' => ['Verbal' => $amt]]);
			}
		}

			if (isset($_POST['uanswer'])){
			$info = $_POST["uanswer"];
			$collection->updateOne(['question' => $uquestion], ['$set' => ['answer' => $info]]);
			}
				
			
		

			$title = $_POST["uqtitle"];



			$info = $_POST["umarks"];
			$marks = (int)$info;



			$q = $_POST["uquestion"];



			$info1 = $_POST["info1"];
			$info2 = $_POST["info2"];
			$info3 = $_POST["info3"];
			$info4 = $_POST["info4"];
			$collection->updateOne(['question' => $uquestion], ['$set' => ['qtitle' => $title, 'marks' => $marks, 'question' => $q, 'option1' => $info1, 'option2' => $info2, 'option3' => $info3, 'option4' => $info4]]);


		
		header('Location: Question Bank.php');
		exit;

?>