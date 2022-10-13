<!DOCTYPE HTML>
<html>

<head>
    <style>
    .error {
        color: #FF0000;
    }
    </style>
</head>

<body>

    <?php
  // define variables and set to empty values
  $nameErr = $ERPErr = $emailErr = $genderErr = $websiteErr = $ERPErr = "";
  $name = $ERP = $email = $gender = $comment = $website = $ERP = "";
  $no_error = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if no errors, then process form data

    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["ERP"])) {
      $ERPErr = "Email is required";
    } else {
      $ERP = test_input($_POST["ERP"]);
      // CHECK IF ERP IS 10 DIGITS NUMBER 
      if (!preg_match("/^[0-9]{10}$/", $ERP)) {
        $ERPErr = "Invalid ERP format";
      }
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=|!:,.;]*[-a-z0-9+&@#\/%=|]/i", $website)) {
        $websiteErr = "Invalid URL";
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = test_input($_POST["gender"]);
    }
    if ($nameErr == "" && $emailErr == "" && $genderErr == "" && $websiteErr == "" && $ERPErr == "") {
      $no_error = true;
    }
  }
  if ($no_error) {
    $conn = mysqli_connect("localhost", "root", "", "fsdlab");

    // Check connection
    if ($conn === false) {
      die("ERROR: Could not connect. "
        . mysqli_connect_error());
    }
    $sql = "INSERT INTO student VALUES ('$name', '$ERP', '$email', '$gender', '$comment', '$website')";

    if (mysqli_query($conn, $sql)) {
      echo "<h3>data stored in a database successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";
    } else {
      echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

    <h2>Get student details</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">*
            <?php echo $nameErr; ?>
        </span>
        <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">*
            <?php echo $emailErr; ?>
        </span>
        <br><br>
        ERP : <input type="text" name="ERP" value="<?php echo $ERP; ?>">
        <span class="error">*
            <?php echo $ERPErr; ?>
        </span>
        <br><br>
        Website: <input type="text" name="website" value="<?php echo $website; ?>">
        <span class="error">
            <?php echo $websiteErr; ?>
        </span>
        <br><br>
        Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
        <br><br>
        Gender:
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>
            value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>
            value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?>
            value="other">Other
        <span class="error">*
            <?php echo $genderErr; ?>
        </span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <!-- insert into mysql next -->
    </form>

    <?php
  echo "<h2>Your Input:</h2>";
  echo $name;
  echo "<br>";
  echo $email;
  echo "<br>";
  echo $ERP;
  echo "<br>";
  echo $website;
  echo "<br>";
  echo $comment;
  echo "<br>";
  echo $gender;



  ?>

</body>

</html>