<!DOCTYPE HTML>
<html>

<head>
    <title>Read</title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "fsdlab");

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
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


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    function fetch($data)
    {
        $conn = generate_connection();
        $sql = "SELECT * FROM student WHERE erp = $data";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    ?>

    <h2>Get student details</h2>
    <!-- take erp as input and get the student details-->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="id">Enter ERP:</label>
        <input type="text" id="erp" name="erp">
        <input type="submit" name="submit" value="Submit">
    </form>
    <!-- on form submit use fetch function-->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $erp = test_input($_POST["erp"]);
        $row = fetch($erp);
        echo "<br>";
        echo "Name: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Gender: " . $row["gender"] . "<br>";
        echo "Comment: " . $row["comment"] . "<br>";
        echo "Website: " . $row["website"] . "<br>";
    }
    // destroy connection
    mysqli_close($conn);
    ?>
</body>

</html>