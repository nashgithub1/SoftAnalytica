<?php
function get_prediction($features) {
    $url = 'http://localhost:5000/predict';  // Flask API URL
    $data = json_encode($features);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }
    curl_close($ch);

    if (isset($error_msg)) {
        return ['error' => $error_msg];
    }

    return json_decode($response, true);
}

// Function to fetch data from database based on user_id
function fetch_data_from_database($user_id) {
    // Example database connection parameters
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_name = 'login_db';

    // Establish database connection
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch GPA from user_profile table
    $sql_gpa = "SELECT GPA FROM user_profile WHERE user_id = $user_id";
    $result_gpa = mysqli_query($conn, $sql_gpa);
    $row_gpa = mysqli_fetch_assoc($result_gpa);
    $gpa = ($row_gpa !== null) ? $row_gpa['GPA'] : 0; // Set GPA to 0 if null

    // Fetch initial test results from quiz_results table
    $initialtest_scores = [];
    $sql_initialtests = "SELECT quiz_type, correct_answer FROM quiz_results WHERE user_id = $user_id AND quiz_type IN ('initial test', 'initial test2', 'initial test3')";
    $result_initialtests = mysqli_query($conn, $sql_initialtests);
    
    while ($row_initialtests = mysqli_fetch_assoc($result_initialtests)) {
        $quiz_type = $row_initialtests['quiz_type'];
        $correct_answer = $row_initialtests['correct_answer'];
        $initialtest_scores[$quiz_type] = $correct_answer;
        #echo "Quiz Type: $quiz_type, Correct Answer: $correct_answer\n";
    }

    // Close database connection
    mysqli_close($conn);

    return [
        'gpa' => $gpa,
        'initialtest1_score' => isset($initialtest_scores['initial test']) ? $initialtest_scores['initial test'] : 0,
        'initialtest2_score' => isset($initialtest_scores['initial test2']) ? $initialtest_scores['initial test2'] : 0,
        'initialtest3_score' => isset($initialtest_scores['initial test3']) ? $initialtest_scores['initial test3'] : 0,
        'user_id' => $user_id
    ];
}

// Example user ID
$user_id = 40;

// Fetch data from database
$data_from_database = fetch_data_from_database($user_id);

// Print fetched data for verification
//print_r($data_from_database);

// Get prediction from Flask API
$prediction = get_prediction($data_from_database);

// Output prediction result
if (isset($prediction['prediction'])) {
    echo 'Prediction: ' . $prediction['prediction'];
} else {
    echo 'No prediction available. Error: ' . (isset($prediction['error']) ? $prediction['error'] : 'Unknown error');
}
?>
