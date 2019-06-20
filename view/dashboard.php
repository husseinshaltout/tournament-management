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
                <h4 class="card-title text-center">Tournments</h4>
                <hr>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="text-success text-center">
                        <?php 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                        ?>
                    </div>
                    <?php endif ?>     
                <!-- Start of post form-->
                <form method="post" action="../server.php" >
                <!-- query to get tournament table -->
                <?php $results = mysqli_query($db, "SELECT * FROM tournament"); ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Tournament Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Tournament Type</th>
                            <th scope="col">Orgainzer</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!--/////////////////EDIT/UPDATE/////////////////-->
                    <!-- /*If edit button is clicked server.php will change value of $update will be changed to true */ -->
                    <?php global $update; if ($update == true): ?>
                    <?php while ($row = mysqli_fetch_array($results)) {  $tid = $row['tournament_id'];?>
                        <!-- //storing value of tournament_id in hidden input -->
                        <input type="hidden" name="tid" value="<?php echo $tid; ?>">

                    <tr>
                        <td><input class="form-control" type="text" value = '<?php echo $row['tour_name']; ?>' name="tour_name"></td>
                        <td><input class="form-control" type="text" value = '<?php echo $row['start_date']; ?>' name="start_date"></td>
                        <td><input class="form-control" type="text" value = '<?php echo $row['end_date']; ?>' name="end_date"></td>
                        <td><input class="form-control" type="text" value = '<?php echo $row['tour_type']; ?>' name="tour_type"></td>
                    <?php $organizer_id_v = $row['organizer_id']; ?>
                    <?php $query = 'SELECT organizer_name FROM organizer WHERE organizer_id="'.$organizer_id_v.'"';

                    $organizer_name = mysqli_query($db, $query);
                    while ($row1 = $organizer_name->fetch_assoc()) {
                        $organizer_name_value =  $row1['organizer_name'];
                    }                    

                    ?>
                        <td><?php echo $organizer_name_value; ?></td>
                    <?php if($id == $tid):?>
                    <td>
                        <button class="btn btn-warning btn-sm" type="submit" name="update">Update</button>
                    </td>                   
                    
                    <?php endif ?>
                    </tr>
                    <?php } ?>
                    <?php else: ?>
                    <!--/////////////////Display/SELECT/////////////////-->
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            <td><?php echo $row['tour_name']; ?></td>
                            <td><?php echo $row['start_date']; ?></td>
                            <td><?php echo $row['end_date']; ?></td>
                            <td><?php echo $row['tour_type']; ?></td>
                            <?php $organizer_id_v = $row['organizer_id']; ?>
                    <?php $query = 'SELECT organizer_name FROM organizer WHERE organizer_id="'.$organizer_id_v.'"';

                    $organizer_name = mysqli_query($db, $query);
                    while ($row1 = $organizer_name->fetch_assoc()) {
                        $organizer_name_value =  $row1['organizer_name'];
                    }                    

                    ?>
                            <td><?php echo $organizer_name_value; ?></td>
                            <td>
                                <a href="dashboard.php?editt=<?php echo $row['tournament_id']; ?>" class="btn btn-primary btn-sm" >Edit</a>
                            </td>
                            <td>
                                <a href="../server.php?delt=<?php echo $row['tournament_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php endif ?>
                    </form>
                    </tbody>
                </table>
                <div class="row justify-content-center">
                <a class="btn btn-warning btn-md justify-content-end" href = "../tour.php" name="addt">Add tournament</a>
                </div>

        </div> <!-- card.// -->
            </div>
        </div>
    </div>


</body>
</html>
