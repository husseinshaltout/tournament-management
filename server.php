<?php
	session_start();
    $db = mysqli_connect('localhost', 'root', '', 'tms');
	// initialize variables for Orgainzer
    $address = "";

    if (isset($_POST['submit_org'])) {
        $organizer_name = $_POST['organizer_name'];
		$organizer_email = $_POST['organizer_email'];
        $address = $_POST['address'];

        mysqli_query($db, "INSERT INTO organizer (organizer_name, address, organizer_email) VALUES ('$organizer_name', '$address', '$organizer_email')"); 
        $_SESSION['organizer_email'] = $organizer_email;//session to pass email
		$_SESSION['message'] = "Organizer added"; 
        header('location: tour.php');
    }
    //initialze for tournment
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
        
        // $_SESSION['organizer_id_value'] = $organizer_id_value;//session to pass organizer_id_value
		$_SESSION['message'] = "Tournment added"; 
		header('location: teams.php');
    }
    //Teams    
    if (isset($_POST['submit_team'])) {
		$tname = $_POST['tname'];
        $pno = $_POST['pno'];
        $tournament_id_value = $_POST['tid'];
        // $organizer_id_value = $_SESSION['organizer_id_value'];//received passed organizer_id_value

        // $query = 'SELECT tournament_id FROM tournament WHERE organizer_id="'.$organizer_id_value.'"';

        // $tournament_id = mysqli_query($db, $query);
        // while ($row = $tournament_id->fetch_assoc()) {            
        //     $tournament_id_value = $row['tournament_id'];            
        // }
        mysqli_query($db, "INSERT INTO team (team_phone, team_name, tournament_id) VALUES ('$pno', '$tname', '$tournament_id_value')"); 
        
        // $_SESSION['pno'] = $pno;//session to pass phone number
		$_SESSION['message'] = "Teams are added"; 
		header('location: player.php');
    }
    if (isset($_POST['add_team'])) {
		$tname = $_POST['tname'];
		$pno = $_POST['pno'];
        $tournament_id_value = $_POST['tid'];
        // $organizer_id_value = $_SESSION['organizer_id_value'];//received passed organizer_id_value

        // $query = 'SELECT tournament_id FROM tournament WHERE organizer_id="'.$organizer_id_value.'"';

        // $tournament_id = mysqli_query($db, $query);
        // while ($row = $tournament_id->fetch_assoc()) {            
        //     $tournament_id_value = $row['tournament_id'];            
        // }
        mysqli_query($db, "INSERT INTO team (team_phone, team_name, tournament_id) VALUES ('$pno', '$tname', '$tournament_id_value')"); 
        
        // $_SESSION['pno'] = $pno;//session to pass phone number
		$_SESSION['message'] = "Team added successfully"; 
		header('location: teams.php');
    }
	// initialize player
    if (isset($_POST['submit_p'])) {
		$player_name = $_POST['player_name'];
        $player_dob = $_POST['player_dob'];
        $player_position = $_POST['player_position'];
        $player_score = $_POST['player_score'];
        $team_id_value = $_POST['tname'];
        // $pno = $_SESSION['pno'];//received passed phone number
        // $query = 'SELECT team_id FROM team WHERE team_name="'.$player_team.'"';

        // $team_id = mysqli_query($db, $query);
        // while ($row = $team_id->fetch_assoc()) {            
        //     $team_id_value =  $row['team_id'];            
        // }


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

        // $pno = $_SESSION['pno'];//received passed phone number
        // $query = 'SELECT team_id FROM team WHERE team_name="'.$player_team.'"';

        // $team_id = mysqli_query($db, $query);
        // while ($row = $team_id->fetch_assoc()) {            
        //     $team_id_value =  $row['team_id'];            
        // }


		mysqli_query($db, "INSERT INTO player (team_id, player_name, player_dob, player_position, player_score) VALUES ('$team_id_value', '$player_name', '$player_dob', '$player_position', '$player_score')"); 
		$_SESSION['message'] = "Players are added successfully"; header('location: player.php');
    }    

    //Delete Tournment
    if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM tournament WHERE tournament_id=$tournament_id1");
		$_SESSION['message'] = $tournament_id1; 
		header('location: view/dashboard.php');
	}
?>