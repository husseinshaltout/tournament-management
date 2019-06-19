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
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['team_name']; ?></td>
                <td><?php echo $row['team_phone']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                </td>
                <td>
                    <a href="server.php?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php } ?>
                    </tbody>
                </table>

        </div> <!-- card.// -->
            </div>
        </div>
    </div>
    <form method="post" action="server.php" >
    <input type="hidden" name="tournament_id" value="<?php echo $tournament_id1; ?>">
    </form>

</body>
</html>
