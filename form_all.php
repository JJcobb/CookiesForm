<?php
	
	function make_cookie($input){

		if ( isset($_POST["$input"]) ) {

			$cookieValue = htmlentities( stripslashes($_POST["$input"]) );
			return $cookieValue;
		}	
	}

	function put_cookie($input){

		if ( isset($_COOKIE["$input"]) ) {
			return $_COOKIE["$input"];
		}

		else if ( !isset($_COOKIE["$input"]) ) {
			return make_cookie("$input");
		}
	}


	function empty_field($field) {

		if ( empty($_POST["$field"]) && isset($_POST['submit']) ) {

			echo "<p class=\"empty\">Please enter a value</p>";

		}
	}


	function show_form(){


		$formFields = ["fname", "lname", "phone", "email", "food", "music", "city", "travel", "power"];

		foreach ($formFields as $input){

			if ( isset($_POST["submit"]) && isset($_COOKIE["$input"]) && ($_COOKIE["$input"] !== $_POST["$input"]) ) {
				unset($_COOKIE["$input"]);
			}
		}
		
?>
	<form action="form_all.php" method="post" name="myForm" id="myForm">

		<fieldset>
			<legend>Personal Info</legend>

				<label for="fname">First Name</label>
				<input type="text" id="fname" name="fname" value="<?php 
																		if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																			echo put_cookie("fname");
																		}
																		
				?>" />
				<?php
					empty_field("fname");
				?>
				

				<label for="lname">Last Name</label>
				<input type="text" id="lname" name="lname" value="<?php
																		if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																			echo put_cookie("lname");
																		}
				?>" />
				<?php
					empty_field("lname");
				?>


				<label for="phone">Phone Number</label>
				<input type="tel" id="phone" name="phone" value="<?php
																		if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																			echo put_cookie("phone");
																		}
				?>" />
				<?php
					empty_field("phone");
				?>

	
				<label for="email">Email Address</label>
				<input type="email" id="email" name="email" value="<?php
																		if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																			echo put_cookie("email");
																		}
				?>" />
				<?php
					empty_field("email");
				?>

		</fieldset>

		<fieldset>
			<legend>Questions</legend>

				<label for="food">What is your favorite food?</label>
				<input type="text" id="food" name="food" value="<?php 
																	if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																		echo put_cookie("food");
																	}
				?>" />
				<?php
					empty_field("food");
				?>


				<label for="music">What is your favorite genre of music?</label>
				<input type="text" id="music" name="music" value="<?php 
																	if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																		echo put_cookie("music");
																	}	
				?>" />
				<?php
					empty_field("music");
				?>


				<label for="city">In what city were you born?</label>
				<input type="text" id="city" name="city" value="<?php 
																	if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																		echo put_cookie("city");
																	}
				?>" />
				<?php
					empty_field("city");
				?>


				<label for="travel">Where would you like to travel to?</label>
				<input type="text" id="travel" name="travel" value="<?php 
																	if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																		echo put_cookie("travel");
																	}
				?>" />
				<?php
					empty_field("travel");
				?>


				<label for="power">If you could have any super power, what would it be?</label>
				<input type="text" id="power" name="power" value="<?php 
																	if ( isset($_POST["submit"]) || isset($_POST["edit"]) ) {
																		echo put_cookie("power");
																	}
			?>" />
				<?php
					empty_field("power");
				?>
				
				
				<input type="submit" id="submit" name="submit" value="Preview Answers" />

		</fieldset>

	</form>
<?php
	} /* end of function show_form() */



	function show_results() {

		if ( isset($_POST['submit']) ) {

			$formFields = ["fname", "lname", "phone", "email", "food", "music", "city", "travel", "power"];

			foreach ($formFields as $input) {

				if ( isset($_POST["$input"]) ) {

					$cookieValue = htmlentities( stripslashes($_POST["$input"]) );
					setcookie("$input", $cookieValue);
				}
			}
		}


		function showData($data) {

			if ( isset($_POST["$data"]) && !empty($_POST["$data"]) ){
				echo htmlentities($_POST["$data"]);
			}
			else {
				echo "<em>no answer</em>";
			}

		}
?>

	<div class="answers">

		<p>First name: <?php
							showData("fname");
			?></p>


		<p>Last name: <?php
							showData("lname");
			?></p>


		<p>Phone number: <?php
							showData("phone");
			?></p>


		<p>Email adress: <?php
							showData("email");
			?></p>


		<hr />


		<p>Favorite food: <?php
							showData("food");
			?></p>


		<p>Favorite genre of music: <?php
							showData("music");
			?></p>


		<p>City you were born in: <?php
							showData("city");
			?></p>	


		<p>Where you would like to travel to: <?php
							showData("travel");
			?></p>	
			

		<p>Your super power: <?php
							showData("power");
			?></p>	


		<form action="form_all.php" method="post" name="results">

			<input type="submit" id="edit" name="edit" value="Edit" />

			<input type="submit" id="finish" name="finish" value="Finish" />

		</form>

	</div>
<?php
	} /* end of function show_results() */


	function show_thanks(){
?>
	<p>Thank you, your data has been submitted</p>

<?php
	} /* end of function show_thanks() */


	if ( isset($_POST['finish']) ) {

		$state = "thanks";
	}

	else if ( isset($_POST['edit']) ) {

		$state = "form";
	}

	else if ( isset($_POST['submit']) ) {

		$formFields = ["fname", "lname", "phone", "email", "food", "music", "city", "travel", "power"];
		
		foreach ($formFields as $input) {

			if ( empty($_POST["$input"]) ) {

				$state = "form";
				break;
			}
			else {
				$state = "results";
			}
		}

	}

	else if ( !isset($_POST['submit']) ) {

		$state = "form";

	}

?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Cookies Form &ndash; Jacob Vogelbacher</title>
		<style> @import url("css/styles.css"); </style>
	</head>
	<body>

		<?php
	    	if ($state == "form") {
				show_form();
			}
			else if ($state == "results") {
				show_results();
			}
			else {
				show_thanks();
			}
		?>		

	</body>
</html>
