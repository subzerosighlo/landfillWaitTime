<?php
// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "landfillwait";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $LandfillName = mysqli_real_escape_string($conn, $_POST['LandfillName']);
    $DatePosted = mysqli_real_escape_string($conn, $_POST['DatePosted']);
    $TimeofWait = mysqli_real_escape_string($conn, $_POST['TimeofWait']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Insert the data into the database
    $sql = "INSERT INTO waittime (LandfillName, DatePosted, TimeofWait, message) VALUES ('$LandfillName', '$DatePosted', '$TimeofWait', '$message')";
    if (mysqli_query($conn, $sql)) {
        $success = true;
    } else {
        $error = true;
    }
}

// Retrieve the wait time data from the database
$sql = "SELECT * FROM waittime ORDER BY DatePosted DESC";
$result = mysqli_query($conn, $sql);
$waittime = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);
?>

<!doctype html>
<html>
<head>
<link rel="manifest" href="manifest.js">
<meta name="theme-color" content="#ffffff"/>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Use a responsive layout -->
    <style>
        .container {
            max-width: 640px;
        }
    </style>

    <script> 
        if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('service_worker.js').then((registration) => {
      console.log('Service worker registered: ', registration);
    }).catch((error) => {
      console.log('Service worker registration failed: ', error);
    });
  });
}
</script>
</head>
<body>

    <div class="container">
        <h1 class="heading">Landfill Wait time</h1>
        <h6>Version: Alpha 1</h6>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hello, User!</strong> This is still in dev stages, so if any errors or problems, be kind!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="about.php">About</a>
  </li>
</ul>
    <!-- Display a success or error message if the form was submitted -->
    <?php if (isset($success)): ?>
        <div class="alert alert-success">Wait time data submitted successfully!</div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger">There was an error submitting the wait time data.</div>
    <?php endif; ?>
    
    <!-- Form to collect wait time data -->
    <form method="post" action="">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="LandfillName">Landfill</label>
                    <input type="text" class="form-control" id="LandfillName" name="LandfillName" required>
                </div>

                <div class="col">
                    <label for="DatePosted">Date</label>
                    <input type="date" class="form-control" id="DatePosted" name="DatePosted" required>
                 </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="TimeofWait">Wait Time (Mins)</label>
                    <input type="number" class="form-control" id="TimeofWait" name="TimeofWait" required>
                </div>

                <div class="col">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>

    </form>

    <!--Table to display data -->

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Landfill</th>
                <th>Date</th>
                <th>Wait Time</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($waittime as $waittime): ?>
                <tr>
                    <td><?php echo $waittime['LandfillName']; ?></td>
                    <td><?php echo $waittime['DatePosted']; ?></td>
                    <td><?php echo $waittime['TimeofWait']; ?> Mins</td>
                    <td><?php echo $waittime['message'];?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>
