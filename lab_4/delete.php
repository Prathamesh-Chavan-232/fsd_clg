<!DOCTYPE HTML>
<html>

<head>
    <title>Delete</title>
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

    function check_if_record_exists($conn, $erp)
    {
        $sql = "SELECT * FROM student WHERE erp = $erp";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return true;
        }
        return false;
    }

    function delete_from_erp($conn, $erp)
    {
        $sql = "DELETE FROM student WHERE erp = $erp";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
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
        $conn = generate_connection();
        if (check_if_record_exists($conn, $erp)) {
            delete_from_erp($conn, $erp);
        } else {
            echo "Record does not exist";
        }
        // destroy connection
        mysqli_close($conn);
    }
    ?>
</body>

</html>