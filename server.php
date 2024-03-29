<?php
    session_start();
    
    //Connect to database
    $db = mysqli_connect('localhost', 'root', '', 'tms');
    $update = false;
    $id = 0;
    $top = false;
    /*INSERT Queries */
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
		$password = $_POST['password'];

        mysqli_query($db, "INSERT INTO users (username, password) VALUES ('$username', '$password')"); 
		$_SESSION['message'] = "user added"; 
        header('location: org.php');
    }
	// insert data from org.php to orgainzer table
    if (isset($_POST['submit_org'])) {
        $organizer_name = $_POST['organizer_name'];
		$organizer_email = $_POST['organizer_email'];
        $address = $_POST['address'];

        mysqli_query($db, "INSERT INTO organizer (organizer_name, address, organizer_email) VALUES ('$organizer_name', '$address', '$organizer_email')"); 
        $_SESSION['organizer_email'] = $organizer_email;//session to pass email
		$_SESSION['message'] = "Organizer added"; 
        header('location: tour.php');
    }
    //insert data from tour.php to tournment table
    if (isset($_POST['submit_tour'])) {
		$tour_name = $_POST['tour_name'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
        $tour_type = $_POST['tour_type'];

        $organizer_email = $_SESSION['organizer_email'];//received passed email
        $query = 'SELECT organizer_id FROM organizer WHERE organizer_email="'.$organizer_email.'"';
        
        $organizer_id = mysqli_query($db, $query);
        while ($row = $organizer_id->fetch_assoc()) {
            $organizer_id_value =  $row['organizer_id'];
        }
        mysqli_query($db, "INSERT INTO tournament (organizer_id, start_date, end_date, tour_type, tour_name) VALUES ('$organizer_id_value', '$start_date', '$end_date', '$tour_type', '$tour_name')"); 
        if($organizer_id_value == 1){
            mysqli_query($db, "INSERT INTO team (team_id, team_phone, team_name, tournament_id) VALUES (0, 0000, 'NO TEAM', 1)"); 
        }
		$_SESSION['message'] = "Tournment added"; 
		header('location: teams.php');
    }
    //insert data from team.php to teams table    
    if (isset($_POST['submit_team'])) {
		$tname = $_POST['tname'];
        $pno = $_POST['pno'];
        $tournament_id_value = $_POST['tid'];

        mysqli_query($db, "INSERT INTO team (team_phone, team_name, tournament_id) VALUES ('$pno', '$tname', '$tournament_id_value')"); 
        

		$_SESSION['message'] = "Teams are added"; 
		header('location: player.php');
    }
    if (isset($_POST['add_team'])) {
		$tname = $_POST['tname'];
		$pno = $_POST['pno'];
        $tournament_id_value = $_POST['tid'];

        mysqli_query($db, "INSERT INTO team (team_phone, team_name, tournament_id) VALUES ('$pno', '$tname', '$tournament_id_value')"); 
		$_SESSION['message'] = "Team added successfully"; 
		header('location: teams.php');
    }
	//insert data from player.php to player
    if (isset($_POST['submit_p'])) {
		$player_name = $_POST['player_name'];
        $player_dob = $_POST['player_dob'];
        $player_position = $_POST['player_position'];
        $player_score = $_POST['player_score'];
        $team_id_value = $_POST['tname'];

		mysqli_query($db, "INSERT INTO player (team_id, player_name, player_dob, player_position, player_score) VALUES ('$team_id_value', '$player_name', '$player_dob', '$player_position', '$player_score')"); 
		$_SESSION['message'] = "Players are added successfully"; 
		header('location: view/dashboard.php');
    }    
    if (isset($_POST['add_p'])) {
		$player_name = $_POST['player_name'];
        $player_dob = $_POST['player_dob'];
        $player_position = $_POST['player_position'];
        $player_score = $_POST['player_score'];
        // $player_team = $_POST['tname'];
        $team_id_value = $_POST['tname'];

		mysqli_query($db, "INSERT INTO player (team_id, player_name, player_dob, player_position, player_score) VALUES ('$team_id_value', '$player_name', '$player_dob', '$player_position', '$player_score')"); 
		$_SESSION['message'] = "Players are added successfully"; header('location: player.php');
    }    
    /*Delete Queries */
    //Delete Tournment
    if (isset($_GET['delt'])) {
        $id = $_GET['delt'];
        mysqli_query($db, 'SET FOREIGN_KEY_CHECKS=0;');
        mysqli_query($db, 'DELETE FROM tournament WHERE tournament_id="'.$id.'"');
        mysqli_query($db, ' SET FOREIGN_KEY_CHECKS=1;');
        
		header('location: view/dashboard.php');
    }   
     //Delete Player
    if (isset($_GET['delp'])) {
        $id = $_GET['delp'];
        mysqli_query($db, 'SET FOREIGN_KEY_CHECKS=0;');
        mysqli_query($db, 'DELETE FROM player WHERE player_id="'.$id.'"');
        mysqli_query($db, ' SET FOREIGN_KEY_CHECKS=1;');
        
		header('location: view/pview.php');
    }    
    //Delete Team
    if (isset($_GET['deltm'])) {
        $id = $_GET['deltm'];

        mysqli_query($db, 'SET FOREIGN_KEY_CHECKS=0;');
        mysqli_query($db, 'DELETE FROM team WHERE team_id="'.$id.'"');
        //update player team id to null
        // mysqli_query($db, 'UPDATE player SET team_name = "NO Team" WHERE team_id="'.$id.'"');
		mysqli_query($db, 'UPDATE player SET team_id= 0 WHERE team_id="'.$id.'"');
        mysqli_query($db, ' SET FOREIGN_KEY_CHECKS=1;');
        
		header('location: view/tview.php');
    }
    /*UPDATE Queries */
    //UPDATE TOURNAMENT
    if (isset($_POST['update'])) {
		$id = $_POST['tid'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $tour_type = $_POST['tour_type'];
        $tour_name = $_POST['tour_name'];
		$record1 = mysqli_query($db, "UPDATE tournament SET tour_name = '$tour_name', start_date='$start_date', end_date='$end_date', tour_type='$tour_type' WHERE tournament_id=$id");
        if (!$record1) {
            printf("Error: %s\n", mysqli_error($db));
 
            exit();
        }
        $_SESSION['message'] = "Tournament updated!"; 
		header('location: ./view/dashboard.php');
    }
    
    if (isset($_GET['editt'])) {
		$id = $_GET['editt'];
		$update = true;
		$record = mysqli_query($db, 'SELECT * FROM tournament WHERE tournament_id="'.$id.'"');
        if (!$record) {
            printf("Error: %s\n", mysqli_error($db));
 
            exit();
        }
		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$start_date = $n['start_date'];
			$end_date = $n['end_date'];
			$tour_type = $n['tour_type'];
		}
    }
    //UPDATE PLAYERVIEW
    if (isset($_POST['updatep'])) {
		$id = $_POST['pid'];
        $player_name = $_POST['player_name'];
        $player_dob = $_POST['player_dob'];
        $player_score = $_POST['player_score'];
        $player_position = $_POST['player_position'];
        $tname = $_POST['tname'];
        mysqli_query($db, 'SET FOREIGN_KEY_CHECKS=0;');
		$record1 = mysqli_query($db, "UPDATE player SET team_id = '$tname', player_name = '$player_name', player_dob='$player_dob', player_score='$player_score', player_position='$player_position' WHERE player_id=$id");
        
        if (!$record1) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        mysqli_query($db, ' SET FOREIGN_KEY_CHECKS=1;');
        $_SESSION['message'] = "Player updated!"; 
		header('location: ./view/pview.php');
    }
    
    if (isset($_GET['editp'])) {
		$id = $_GET['editp'];
		$update = true;
		$record = mysqli_query($db, 'SELECT * FROM player WHERE player_id="'.$id.'"');
        if (!$record) {
            printf("Error: %s\n", mysqli_error($db));
 
            exit();
        }
		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$player_name = $n['player_name'];
			$player_dob = $n['player_dob'];
			$player_score = $n['player_score'];
			$player_position = $n['player_position'];
		}
    }
       //UPDATE TEAMVIEW
       if (isset($_POST['updatet'])) {
		$id = $_POST['tid'];
        $team_name = $_POST['team_name'];
        $team_phone = $_POST['team_phone'];
        mysqli_query($db, 'SET FOREIGN_KEY_CHECKS=0;');
		$record1 = mysqli_query($db, "UPDATE team SET  team_name = '$team_name', team_phone='$team_phone' WHERE team_id=$id");
        
        if (!$record1) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        mysqli_query($db, ' SET FOREIGN_KEY_CHECKS=1;');
        $_SESSION['message'] = "Team updated!"; 
		header('location: ./view/tview.php');
    }
    
    if (isset($_GET['edittm'])) {
		$id = $_GET['edittm'];
		$update = true;
		$record = mysqli_query($db, 'SELECT * FROM team WHERE team_id="'.$id.'"');
        if (!$record) {
            printf("Error: %s\n", mysqli_error($db));
 
            exit();
        }
		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$team_name = $n['team_name'];
			$team_phone = $n['team_phone'];

		}
    }
    if (isset($_GET['top'])) {
		// $id = $_GET['edittm'];
		$top = true;
	// 	$record = mysqli_query($db, 'SELECT * FROM team WHERE team_id="'.$id.'"');
    //     if (!$record) {
    //         printf("Error: %s\n", mysqli_error($db));
 
    //         exit();
    //     }
	// 	if (@count($record) == 1 ) {
	// 		$n = mysqli_fetch_array($record);
	// 		$team_name = $n['team_name'];
	// 		$team_phone = $n['team_phone'];

	// 	}
	}
?>