<?php include 'getAndPost.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>get and post assignments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<div class="row gx-0 --bs-dark" style="background-color:#212529; color:aliceblue;">

<div class="col-5">
    <form class="col-*  form-group" action="gapHTML.php" method="REQUEST">
        <div class="form-group row">
            <label >Age from: </label>
            <input type="number" placeholder="Enter Age" name="age_from" value="<?php echo isset($_REQUEST['age_from']) ? $_REQUEST['age_from'] : ''; ?>"><br>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-6">Remove Students: </label>
            <input class="col-1" type="checkbox" name="exclude_students" value="1"><br>
        </div>
        <br>
        <div class="form-group row">
            <input class="btn btn-dark btn-outline-secondary" type="submit" value="Filter"><br>
            <button class="btn btn-dark btn-outline-secondary" type="button" onclick="window.location.href='gapHTML.php'">Clear filter</button><br>
        </div>
    </form>

    <form class="col-5" method="POST" action="gapHTML.php">
        <label>Name:</label><br>
        <input type="text" name="form_Name" value=""><br>
        <label>Age:</label><br>
        <input type="number" name="form_Age" value=""><br>
        <label>Profession:</label><br>
        <input type="text" name="form_Prof" value=""><br><br>
        <input type="hidden" name="form_submitted" value="1">
        <input type="submit" value="Add Person">
    </form>
<br>
    <form method="POST" action="gapHTML.php">
        <label> Delete User by their ID</label><br>
        <label>User ID:</label><br>
        <input type="number" name="user_id"><br>
        <input type="submit" value="Delete">
    </form>

    <form action="gapHTML.php" method="POST">
        <label>ID: </label><input type="number" name="user_id2" value=""><br>
        <label>Name: </label><input type="text" name="Name" value=""><br>
        <label>Age: </label><input type="number" name="Age" value=""><br>
        <label>Profession: </label><input type="text" name="Profession" value=""><br>
            <input type="submit" value="Edit">
    </form>
</div>

<div class="col-7">
    <table class="table table-dark table-striped table-hover table-bordered border-secondary ">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Profession</th>
        </tr>
        <?php tableFE($filtered_arr); ?>
    </table>
</div>
</div>
