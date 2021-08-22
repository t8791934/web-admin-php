<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $review_id = $_POST["review_id"];

    // $sql = "SELECT * FROM recipe_reviews WHERE review_id = $review_id";
    $sql = "DELETE FROM recipe_reviews WHERE review_id = $review_id";

    if ($conn->query($sql) === TRUE) {
    //   echo "Record deleted successfully";
      header("location: recipe_review_list.php");
    } else {
      echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
?>
