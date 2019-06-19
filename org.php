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
                    <h4 class="card-title text-center">Setup Organization</h4>
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
                    <input type="hidden" name="organizer_id" value="<?php echo $organizer_id; ?>">
                        <div class="form-row mt-2 mb-2">
                            <div class="col">
                            <input type="text" class="form-control" name="organizer_name"  placeholder="Organizer name">
                            </div>
                        </div>
                        <div class="form-row mt-2 mb-2">
                            <div class="col">
                            <input type="email" class="form-control" name="organizer_email"  placeholder="Organizer email">
                            </div>
                        </div>
                        <div class="form-row mt-2 mb-2">
                            <div class="col">
                            <input type="text" class="form-control" name="address"  placeholder="Address">
                            </div>
                        </div>
                        <div class="form-row mt-2 mb-2 justify-content-center">
                            <div class="col-6">                                
                            <button class="float-right btn btn-md btn-success btn-block" name="submit_org" type="submit">Submit</button>                                
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