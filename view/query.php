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
                <h4 class="card-title text-center">Top 5 Players</h4>
                <hr>    
                <!-- Start of post form-->                
                <!-- query to get top 5 plauers-->
                <?php $results = mysqli_query($db, "SELECT * FROM player order by player_score DESC limit 5"); ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Player name</th>
                            <th scope="col">Player DOB</th>
                            <th scope="col">Player score</th>
                            <th scope="col">Player position</th>
                            <th scope="col">Team</th>
                        </tr>
                    </thead>
                    <tbody>                
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
                            }?>
                            <td><?php echo $team_name_value; ?></td>
                        </tr>
                    <?php }?>                
                    
                    </tbody>
                </table>
                <div class="row justify-content-center">
                <a class="btn btn-warning btn-md justify-content-end" href = "pview.php" name="addt">View Players</a>
                </div>

        </div> <!-- card.// -->
            </div>
        </div>
    </div>


</body>
</html>
