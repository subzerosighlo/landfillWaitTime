<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$DatePosted = $title = $updatePost = "";
$DatePosted_err = $title_err = $updatePost_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate Date
    $input_DatePosted = trim($_POST["DatePosted"]);
    if(empty($input_DatePosted)){
        $DatePosted_err = "Please enter a date.";
    } else{
        $DatePosted = $input_DatePosted;
    }
    
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title";     
    } else{
        $title = $input_title;
    }
    
    // Validate Post
    $input_updatePost = trim($_POST["updatePost"]);
    if(empty($input_updatePost)){
        $updatePost_err = "Please enter the post update";     
    } else{
        $updatePost = $input_updatePost;
    }
    
    // Check input errors before inserting in database
    if(empty($DatePosted_err) && empty($title_err) && empty($updatePost_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO projectupdates (DatePosted, title, updatePost) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_DatePosted, $param_title, $param_updatePost);
            
            // Set parameters
            $param_DatePosted = $DatePosted;
            $param_title = $title;
            $param_updatePost = $updatePost;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: dashboard.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add update post record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="DatePosted" class="form-control <?php echo (!empty($DatePosted_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DatePosted; ?>">
                            <span class="invalid-feedback"><?php echo $DatePosted_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Post Update</label>
                            <textarea name="updatePost" class="form-control <?php echo (!empty($updatePost_err)) ? 'is-invalid' : ''; ?>"><?php echo $updatePost; ?></textarea>
                            <span class="invalid-feedback"><?php echo $updatePost_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="dashboard.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>