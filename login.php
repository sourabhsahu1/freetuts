<?php 
	include 'core/init.php';
	include 'includes/overall/header.php';


	if (empty($_POST) === false) {
		$username= $_POST['username'];
		$password= $_POST['password'];
	

	if (empty($username) === true || empty($password) === true ) {
		$errors[] = 'You need to enter a username and password';
	}

	elseif (user_exists($username) === false) {
		$errors[] = 'we can\'t find that username . Have you registered ?';
	}

	elseif (user_active($username) === false) {
		$errors[] = 'You haven\'t activated your account';
	}

	else{
		$login = login($username, $password);
		if ($login===false) {
			$errors[]= 'That username/ password combination is incorrect';

		} else{

			
			//set the user session
			$_SESSION['user_id']= $login;
			
			//redirect user to home
			header('Location:index.php');
			exit();
		}
	}

	print_r($errors);
	
	}

	
	include 'includes/overall/footer.php';
?>