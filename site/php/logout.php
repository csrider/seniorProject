<?php

//START-UP ROUTINES
	session_start();

//CHECK TO MAKE SURE THEY ARE CURRENTLY LOGGED-INTO AN ACTIVE SESSION
	if (isset($_SESSION['user_online_record'])) {
		session_destroy();
		header("Location: ../index.php" );
	}
	else {
		header("Location: ../index.php" );
	}

?>