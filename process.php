<?php

function isPrime($num) {
    if ($num < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i === 0) {
            return false;
        }
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $number = isset($_POST["number"]) ? intval($_POST["number"]) : 0;

    if ($number > 0) {
        if (isPrime($number)) {
            // Perform database insertion (replace with your database code)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "prime";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO functions (number) VALUES ($number)";

            if ($conn->query($sql) === TRUE) {
                echo "Number $number is prime and has been inserted into the table.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Number $number is not prime.";
        }
    } else {
        echo "Please enter a valid positive number.";
    }
} else {
    echo "Invalid request.";
}
?>
