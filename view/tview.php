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
                <h4 class="card-title text-center">Teams</h4>
                <hr>
                <!-- <?php if (isset($_SESSION['message'])): ?>
                    <div class="text-success text-center">
                        <?php 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                        ?>
                    </div>
                    <?php endif ?>    -->
                <form method="post" action="../server.php" > 
                <!-- query to get team table -->                                       
                <?php $results = mysqli_query($db, "SELECT * FROM team"); ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Team name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!--/////////////////EDIT/UPDATE/////////////////-->
                    <!-- /*If edit button is clicked server.php will change value of $update will be changed to true */ -->
                    <?php if ($update == true): ?>
                    <?php while ($row = mysqli_fetch_array($results)) { $tid = $row['team_id']; ?>
                    <!-- storing value of team_id in hidden input -->
                    <input type="hidden" name="tid" value="<?php echo $tid; ?>">
                    <tr>
                    <td><input class="form-control" type="text" value = '<?php echo $row['team_name']; ?>' name="team_name"></td>
                    <td><input class="form-control" type="text" value = '<?php echo $row['team_phone']; ?>' name="team_phone"></td>                        
                    <?php if($id1 == $tid):?>
                    <td>
                        <button class="btn btn-warning btn-sm" type="submit" name="updatet">Update</button>
                    </td>                   
                    <?php endif ?>
                    <?php } ?>
                    </tr>
                    <?php else: ?>
                    <!--/////////////////Display/SELECT/////////////////-->
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['team_name']; ?></td>
                        <td><?php echo $row['team_phone']; ?></td>

                        <?php $tmid = $row['team_id'];?>
                        <!-- If NO TEAM hide edit and delete buttons -->
                        <?php if($tmid == 1){ echo NULL;}else{?>
                        <td>
                            <a href="tview.php?edittm=<?php echo $tmid;?>" class="btn btn-primary btn-sm">Edit</a>
                        </td>                        
                        <td>
                            <a href="../server.php?deltm=<?php if($tmid == 1){ echo NULL;}else{echo $tmid;} ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php endif ?>
                </form>
                    </tbody>
                </table>
                <div class="row justify-content-center">
                <a class="btn btn-warning btn-md justify-content-end" href = "../teams.php" name="addt">Add Team</a>
                </div>

        </div> <!-- card.// -->
            </div>
        </div>
    </div>

</body>
</html>
