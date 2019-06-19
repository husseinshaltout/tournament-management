<?php  include('server.php'); ?>
<?php include "header.php"; ?>
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
            <div class="row justify-content-center">
                    <div class="col-lg-6">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center">Add Teams</h4>
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
                    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">

                        <div class="form-group row justify-content-center">
                            <div class="col-4">
                            <input class="form-control" type="text" placeholder="Team" name = "tname" id="example-text-input">
                            </div>
                            <div class="col-4">
                            <input class="form-control" type="number" placeholder="1-(555)-555-5555" name = "pno"  id="text-input-phone">                               
                            </div>    
                            <div class="col-4">
                            <select name = "tid" class="form-control">
                                <?php $query = 'SELECT tournament_id,tour_name FROM tournament';
                                    $tournament_id = mysqli_query($db, $query);
                                    while ($row1 = $tournament_id->fetch_assoc()) {
                                        $tournament_id_value =  $row1['tournament_id'];
                                        $tournament_name_value =  $row1['tour_name'];

                                        echo "<option value ='$tournament_id_value'>$tournament_name_value</option>";
                                    }?>  

                            </select>                             
                            </div>                         
                        </div> 
                                                                                                
                        <div class="form-group row justify-content-center">
                            <div class="col-5">                                
                            <button class="btn btn-md btn-success btn-block" name="add_team" type="submit">Add Team</button>                                
                             </div>                                                          
                             <div class="col-5">                                
                            <button class="btn btn-md btn-success btn-block" name="submit_team" type="submit">Submit</button>                                
                             </div>
                        </div>                   
                    </form>
                </div> <!-- card.// -->
                    </div>
            </div>
        </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>