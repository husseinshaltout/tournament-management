<?php  include('../server.php'); ?>
<?php  include('header.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tournment Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>
<body>

    <div class="container mt-4 mb-4">

        <div class="row  justify-content-center">
            <div class="col-lg-12">  
        <div class="card">
            <article class="card-body">
                <h4 class="card-title text-center">Players</h4>
                <hr>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="text-success text-center">
                        <?php 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                        ?>
                    </div>
                    <?php endif ?>                                           
                <form method="post" action="../server.php" >
                <?php $results = mysqli_query($db, "SELECT * FROM player"); ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Player name</th>
                            <th scope="col">Player DOB</th>
                            <th scope="col">Player score</th>
                            <th scope="col">Player position</th>
                            <th scope="col">Team</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!--/////////////////EDIT/UPDATE/////////////////-->
                    <?php if ($update == true): ?>
                    <?php while ($row = mysqli_fetch_array($results)) { $pid = $row['player_id']; ?>
                    <!-- storing value of player_id in hidden input -->
                    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                    <tr>
                    <td><input class="form-control" type="text" value = '<?php echo $row['player_name']; ?>' name="player_name"></td>
                    <td><input class="form-control" type="text" value = '<?php echo $row['player_dob']; ?>' name="player_dob"></td>
                    <td><input class="form-control" type="text" value = '<?php echo $row['player_score']; ?>' name="player_score"></td>
                    <td><input class="form-control" type="text" value = '<?php echo $row['player_position']; ?>' name="player_position"></td>
                    <!-- To display Team Name -->
                    <?php $team_id_v = $row['team_id']; ?>
                    <?php $query = 'SELECT team_name,team_id FROM team WHERE team_id="'.$team_id_v.'"';
                    $team_name = mysqli_query($db, $query);
                    while ($row1 = $team_name->fetch_assoc()) {
                        $team_id_value =  $row1['team_id'];
                        $team_name_value =  $row1['team_name'];
                    }                    
                    ?>
                    <!-- Display all available teams -->
                    <td><select name = "tname" class="form-control"><?php echo "<option value ='$team_id_value'>$team_name_value</option>";//Current player team ?>
                    <?php $query = 'SELECT team_name,team_id FROM team';
                                    $team_id = mysqli_query($db, $query);
                                    while ($row1 = $team_id->fetch_assoc()) {
                                        $team_name_value =  $row1['team_name'];
                                        $team_id_value =  $row1['team_id'];
                                        echo "<option value ='$team_id_value'>$team_name_value</option>";
                                    }?> 
                    
                    
                    </select> </td>
                    <?php if($id == $pid):?>
                    <td>
                        <button class="btn btn-warning btn-sm" type="submit" name="updatep">Update</button>
                    </td>                   
                    <?php endif ?>
                    </tr>
                    <?php } ?>
                    <?php else: ?>
                    <!--/////////////////Display/SELECT/////////////////-->
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            <td><?php echo $row['player_name']; ?></td>
                            <td><?php echo $row['player_dob']; ?></td>
                            <td><?php echo $row['player_score']; ?></td>
                            <td><?php echo $row['player_position']; ?></td>
                            <?php $team_id_v = $row['team_id']; ?>
                    <?php $query = 'SELECT team_name FROM team WHERE team_id="'.$team_id_v.'"';

                    $team_name = mysqli_query($db, $query);
                    while ($row1 = $team_name->fetch_assoc()) {
                        $team_name_value =  $row1['team_name'];
                    }                    

                    ?>
                            <td><?php echo $team_name_value; ?></td>
                            <td>
                                <a href="pview.php?editp=<?php echo $row['player_id']; ?>" class="btn btn-primary btn-sm" >Edit</a>
                            </td>
                            <td>
                                <a href="../server.php?delp=<?php echo $row['player_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php endif ?>
                    </form>
                    </tbody>
                </table>
                <div class="row justify-content-center">
                <a class="btn btn-warning btn-md justify-content-end" href = "../player.php" name="addp">Add Player</a>
                </div>
        </div> <!-- card.// -->
            </div>
        </div>
    </div>

</body>
</html>
