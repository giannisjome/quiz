<?php
	require 'config/config.php';

	$student_query=mysqli_query($con, "SELECT * FROM games WHERE user_to='$user'");
	$result=mysqli_fetch_array($student_query);
	$questions=$result['questions'];
	$question=explode(',', $questions);
	$num=count($question);
	for ($i = 0; $i < $num; $i++) {
 	 echo "<p id='question$i'class='allquestions' style='visibility:hidden;'>$question[$i]</p> <br>";
	}


	$answers=$result['answers'];
	$answer=explode(',', $answers);
	$n=0;
	for ($i = -2; $i < $num-2; $i++) {
		$h=$n+1;
		$j=$h+1;
		$k=$j+1;
		$l=$k+1;
		$n=$n+4;//for next 4 answers of the next question
 	 echo "<p id='answerN$h'class='allanswers' style='visibility:hidden;'>$answer[$h]</p> <br>";
 	 echo "<p id='answerN$j'class='allanswers' style='visibility:hidden;'>$answer[$j]</p> <br>";
 	 echo "<p id='answerN$k'class='allanswers' style='visibility:hidden;'>$answer[$k]</p> <br>";
 	 echo "<p id='answerN$l'class='allanswers' style='visibility:hidden;'>$answer[$l]</p> <br>";
	}


	//send answers
	$teacher= $result['creator'];
	if(isset($_POST['submit_answers'])) {
		$final_answers=$_POST['answer_array'];
		echo $final_answers;
		$query=mysqli_query($con, "INSERT INTO games VALUES ('','GOOD', '$num', 'cuckoo', '$teacher', 'max', 'questions', '$final_answers', 'nine', 'nice game!', 'no', 'no')");
	}

?>
<head>
	<title>Owl</title>
	<link rel="stylesheet" href="css/gameplay.css">
	<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
	<form method="POST" action="" >
	<div id="questions" onmouseover="animation_stop();" onmouseout="animation_played();"> <!-- div for hidding and display the questions -->
		<div class="question_box"></div>
		<div class="question"><p id="question"><?php 
		if(isset($_POST["answer1"])) {
			echo $question[1];
		}
		else {
		 echo $question[0];
		}
		?>
		</p></div>
		<?php $mixed=array("$answer[0]", "$answer[1]", "$answer[2]", "$answer[3]");
		shuffle($mixed);
		?>
		<div id="answer_box1" class="answer_box"><p id="answer1" class="answer" onclick="display_questions_btn1();"><?php echo $mixed[0]; ?></p></div>
		<div id="answer_box2" class="answer_box"><p id="answer2" class="answer" onclick="display_questions_btn1();"><?php echo $mixed[1]; ?></p></div>
		<div id="answer_box3" class="answer_box"><p id="answer3" class="answer" onclick="display_questions_btn1();"><?php echo $mixed[2]; ?></p></div>
		<div id="answer_box4" class="answer_box"><p id="answer4" class="answer" onclick="display_questions_btn1();"><?php echo $mixed[3]; ?></p></div>
		<p id="answer_array"  name="answer_array"></p>
		<input type="submit" value="finish" name="submit_answers" id="finish_btn" class="btn btn-lg btn-success" style="position: absolute;top: 515px;z-index: 15;left: 425px;border-radius:15px;background-color: #2ecc71;width: 200px;height: 60px;color: #FFF;font-family: 'Fredoka One', cursive;font-size: 25px;cursor: pointer;visibility: hidden;"><i class="fa fa-check"></i> </input>
	</div>
	</form>


	<div id="speech">
		<div id="bubble1"></div>
		<div id="bubble2"></div>
		<div id="bubble3"></div>
	</div>
	<p id="owl_ask" style="position: absolute; top: 140px; left: 250px; font-size: 25px; font-weight: bold;">
		<?php

		?>

	</p>
  	<i id="question_icon" class="fa fa-question-circle-o" style="font-size:48px;color:red; position: absolute; top: 525px; left: 700px;" onclick="help();"></i>
  	<button id="ok" class="btn btn-lg btn-success" onclick="hide_help();"><i class="fa fa-check"></i> OK</button>

	<script>
		//change question
		var clicked=0;
		function next() {
		var number= document.getElementsByClassName("allquestions");
		var num= number.length;
		if (clicked < num) {
		setTimeout(function(){ change()}, 1500);
			}

		
		}


		function change() {
		if(clicked==0){
			document.getElementById("question").innerHTML= document.getElementById("question1").innerHTML;
			

			//answers
		
			
		}
		else if (clicked==1){
			document.getElementById("question").innerHTML= document.getElementById("question2").innerHTML;
		}
		 clicked++;
		} 



	function animation_stop() {
		document.getElementById("eyelid_r").style.animationPlayState = "paused";
		document.getElementById("eyelid_l").style.animationPlayState = "paused";
		document.getElementById("eyelid_r").style.height="25px";
		document.getElementById("eyelid_l").style.height="25px";
	}

	function animation_played() {
		document.getElementById("eyelid_r").style.animationPlayState = "running";
		document.getElementById("eyelid_l").style.animationPlayState = "running";
		document.getElementById("eyelid_r").style.height="50px";
		document.getElementById("eyelid_l").style.height="50px";
	}

	function help() {
		document.getElementById("questions").style.visibility="hidden";
		document.getElementById("question_icon").style.visibility="hidden";
		setTimeout(function(){ document.getElementById("bubble1").style.visibility="visible"; }, 500);
		setTimeout(function(){ document.getElementById("bubble2").style.visibility="visible"; }, 1000);
		setTimeout(function(){ document.getElementById("bubble3").style.visibility="visible"; }, 1500);
		setTimeout(function(){ document.getElementById("ok").style.visibility="visible"; }, 2500);
		

	}
	function hide_help() {
		document.getElementById("bubble1").style.visibility="hidden";
		document.getElementById("bubble2").style.visibility="hidden";
		document.getElementById("bubble3").style.visibility="hidden";
		document.getElementById("ok").style.visibility="hidden";
		document.getElementById("questions").style.visibility="visible";
		document.getElementById("question_icon").style.visibility="visible";
	}
	function music() {
		document.getElementById("music_off").style.visibility="hidden";
		document.getElementById("music_on").style.visibility="visible";
		document.getElementById("audio").play();
	}
	function music_stop() {
		document.getElementById("music_off").style.visibility="visible";
		document.getElementById("music_on").style.visibility="hidden";
		document.getElementById("audio").pause();
	}
	


	function ask() {
		document.getElementById("questions").style.visibility="hidden";
		setTimeout(function(){ document.getElementById("bubble1").style.visibility="visible"; }, 500);
		setTimeout(function(){ document.getElementById("bubble2").style.visibility="visible"; }, 1000);
		setTimeout(function(){ document.getElementById("bubble3").style.visibility="visible"; }, 1500);
		
		setTimeout(function(){document.getElementById("ok").style.visibility="visible"; }, 2500);
	}
	
	var clicks=0;
	var student_answers=[];
	function display_questions_btn1() {
		
		var c = document.getElementsByClassName("allquestions").length;
  		console.log(c);
  		console.log(clicks);
  		if (clicks < c) {
  		
  			if (clicks==0) {
  				//save student answer
  				var given_answer= document.getElementById("answer1").innerHTML;
		  		student_answers.push(given_answer);


  				//display next question
		  		document.getElementById("question").innerHTML=document.getElementById("question1").innerHTML;


		  		//display next answers
		  		document.getElementById("answer1").innerHTML=document.getElementById("answerN5").innerHTML;
		  		document.getElementById("answer2").innerHTML=document.getElementById("answerN6").innerHTML;
		  		document.getElementById("answer3").innerHTML=document.getElementById("answerN7").innerHTML;
		  		document.getElementById("answer4").innerHTML=document.getElementById("answerN8").innerHTML;
		  		
		  		
  			}
  			else if (clicks==1) {
  				//save student answer
  				var given_answer= document.getElementById("answer1").innerHTML;
		  		student_answers.push(given_answer);
  				//display next question
		  		document.getElementById("question").innerHTML=document.getElementById("question2").innerHTML;


		  		//display next answers
		  		document.getElementById("answer1").innerHTML=document.getElementById("answerN9").innerHTML;
		  		document.getElementById("answer2").innerHTML=document.getElementById("answerN10").innerHTML;
		  		document.getElementById("answer3").innerHTML=document.getElementById("answerN11").innerHTML;
		  		document.getElementById("answer4").innerHTML=document.getElementById("answerN12").innerHTML;
		  		
		  		
  			}
  			else {
  				//save student answer
  				var given_answer= document.getElementById("answer1").innerHTML;
		  		student_answers.push(given_answer);
		  		//display submit btn
  				document.getElementById("finish_btn").style.visibility="visible";
  			}
		}
		clicks++;
		document.getElementById("answer_array").innerHTML= student_answers;
	}
	</script>
</body>
