<?php

// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$_id = NULL;

if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $user = $userModel->findUserById($_id);//Update existing user
}


if (!empty($_POST['submit'])) {
 

    if (!empty($_id)) {
        $userModel->updateUser($_POST);
    } else {
        // var_dump(empty($_id));die();
        $userModel->insertUser($_POST);
    }
    header('location: list_users.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php'?>
    <div class="container">

        <?php if ($user || !isset($_id)) { ?>

        <div class="alert alert-warning" role="alert">
            User form
        </div>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $_id ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" name="name" placeholder="Name"
                    value="<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input class="form-control" name="fullname" placeholder="fullname">
            </div>
            <div class="form-group">
            <label for="sex">Sex</label>
                <select class="form-select" aria-label="Default select example" name="sex">
                    <option selected>Other</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php } else { ?>
        <div class="alert alert-success" role="alert">
            User not found!
        </div>
        <?php } ?>
    </div>
</body>

</html>