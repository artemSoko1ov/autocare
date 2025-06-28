<?php
require_once "BdConnect.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    if($rating === "5"){
        $rating = "★★★★★";
    }
    else if($rating === "4"){
        $rating = "★★★★☆";
    }
    else if($rating === "3"){
        $rating = "★★★☆☆";
    }
    else if($rating === "2"){
        $rating = "★★☆☆☆";
    }
    else if($rating === "1"){
        $rating = "★☆☆☆☆";
    }
    
    $sql = "INSERT INTO reviews (name, review, rating) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $review, $rating]);

    echo json_encode(["success" => true]);
}
?>
