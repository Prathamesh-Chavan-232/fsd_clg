<!DOCTYPE HTML>
<html>

<head>
    <style>
    .error {
        color: #FF0000;
    }
    </style>
    <title>Create or Update</title>
</head>



<body>
    <p><span class="error">* required field</span></p>
    <?php
    $nameErr = $ERPErr = $emailErr = $genderErr = $websiteErr = $ERPErr = "";
    $name = $ERP = $email = $gender = $comment = $website = $ERP = "";
    $no_error = false;
    ?>
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
    $nameErr = $ERPErr = $emailErr = $genderErr = $websiteErr = $ERPErr = "";
    $name = $ERP = $email = $gender = $comment = $website = $ERP = "";
    $no_error = false;

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function generate_connection()
    {
        $conn = mysqli_connect("localhost", "root", "", "fsdlab");
        if ($conn === false) {
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        return $conn;
    }

    function check_if_records_exists($conn, $ERP)
    {
        $sql = "SELECT * FROM student WHERE erp = $ERP";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return true;
        }
        return false;
    }

    function insert_record($conn, $name, $ERP, $email, $gender, $comment, $website)
    {
        $sql = "INSERT INTO student VALUES ('$name', '$ERP', '$email', '$gender', '$comment', '$website')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully !";
        } else {
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
    }

    function onPost()
    {
        global $nameErr, $ERPErr, $emailErr, $genderErr, $websiteErr, $ERPErr, $name, $ERP, $email, $gender, $comment, $website, $ERP, $no_error;

        $conn = generate_connection();

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
            $ERPErr = "ERP is required";
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
            insert_data($conn, $name, $ERP, $email, $gender, $comment, $website);
        } else {
            echo "Please fill the form correctly";
            echo "<br>";
            echo $nameErr;
            echo "<br>";
            echo $emailErr;
            echo "<br>";
            echo $genderErr;
            echo "<br>";
            echo $websiteErr;
            echo "<br>";
            echo $ERPErr;
        }

        mysqli_close($conn);
    }
    function update_record($conn, $name, $ERP, $email, $gender, $comment, $website)
    {
        $sql = "UPDATE student SET name = '$name', email = '$email', gender = '$gender', comment ='$comment', website = '$website' WHERE erp = $ERP";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully !";
        } else {
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
    }

    function insert_data($conn, $name, $ERP, $email, $gender, $comment, $website)
    {
        if (check_if_records_exists($conn, $ERP)) {
            echo "Record already exists <br>";
            update_record($conn, $name, $ERP, $email, $gender, $comment, $website);
        } else {
            insert_record($conn, $name, $ERP, $email, $gender, $comment, $website);
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        onPost();
    }
    ?>

</body>

</html>