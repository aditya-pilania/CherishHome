<?php
include 'db-connection.php';

// Fetch adopter preferences
$adopter_id = $_GET['adopter_id']; // Get adopter ID from request
$adopter_query = "SELECT preferences FROM adopters WHERE id = $adopter_id";
$adopter_result = $conn->query($adopter_query);
$adopter = $adopter_result->fetch_assoc();
$preferences = strtolower($adopter['preferences']);

// Fetch all children
$children_query = "SELECT * FROM children";
$children_result = $conn->query($children_query);

$best_match = null;
$highest_score = 0;

while ($child = $children_result->fetch_assoc()) {
    $child_interests = strtolower($child['interests']);
    
    // Calculate similarity score
    similar_text($preferences, $child_interests, $score);
    
    // Find the best match
    if ($score > $highest_score) {
        $highest_score = $score;
        $best_match = $child;
    }
}

// Return the best match
if ($best_match) {
    echo "Best match for adoption: " . $best_match['cname'] . " (Interests: " . $best_match['interests'] . ")";
} else {
    echo "No suitable match found.";
}

?>
