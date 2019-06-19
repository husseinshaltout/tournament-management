<?php  include('server.php'); ?>
<?php include "header.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tournment Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>

<body>
        <div class="container mt-4 mb-4">
            <div class="row">
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
                    <form method = "POST" action = "./server.php">
                    <div class="form-group row justify-content-center">
                            <div class="col-2">
                            <label for="example-text-input" class="col-form-label">Player Name</label>
                            </div>
                            <div class="col-2">
                            <label for="example-text-input" class="col-form-label">Player DOB</label>
                            </div>    
                            <div class="col-2">
                            <label for="example-text-input" class="col-form-label">Player Position</label>
                            </div> 
                            <div class="col-2">
                            <label for="example-text-input" class="col-form-label">Player Score</label>
                            </div>   
                            <div class="col-2">
                            <label for="example-text-input" class="col-form-label">Team</label>
                            </div>                      
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-2">
                            <input class="form-control" type="text" placeholder="Name" name = "player_name" id="example-text-input">
                            </div>
                            <div class="col-2">
                            <input class="form-control" type="date" value="2011-08-19" name = "player_dob" id="example-date-input">                               
                            </div>    
                            <div class="col-2">
                            <input class="form-control" type="text" placeholder="Position" name = "player_position" id="example-text-input">
                            </div> 
                            <div class="col-2">
                            <input class="form-control" type="number" placeholder="Score" name = "player_score" id="example-text-input">
                            </div>   
                            <div class="col-2">
                            <select name = "tname" class="form-control">
                                <?php $query = 'SELECT team_name,team_id FROM team';
                                    $team_id = mysqli_query($db, $query);
                                    while ($row1 = $team_id->fetch_assoc()) {
                                        $team_name_value =  $row1['team_name'];
                                        $team_id_value =  $row1['team_id'];
                                        echo "<option value ='$team_id_value'>$team_name_value</option>";
                                    }?>  
                            </select>                             
                            </div> 
                        </div> 
                        
                                                                                                
                        <div class="form-group row justify-content-around">
                            <div class="col-3">                                
                            <button class="btn btn-md btn-success btn-block" name="add_p" type="submit">Add Player</button>                                
                             </div>
                             <div class="col-3">                                
                            <button class="btn btn-md btn-success btn-block" name = "submit_p" type="submit">Submit</button>                                
                             </div>
                        </div>                   
                    </form>
                </div> <!-- card.// -->
                    </div>
            </div>
        </div>



</body>
</html>