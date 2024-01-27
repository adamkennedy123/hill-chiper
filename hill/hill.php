<?php

function matrix_inverse($matrix, $mod)
{
    $det = det($matrix);
    $inv_det = null;

    for ($i = 1; $i < $mod; $i++) {
        if (($det * $i) % $mod == 1) {
            $inv_det = $i;
            break;
        }
    }

    if ($inv_det === null) {
        throw new Exception("Modular inverse does not exist.");
    }

    $adj_matrix = [
        [$matrix[1][1], -$matrix[0][1]],
        [-$matrix[1][0], $matrix[0][0]]
    ];

    $inverse_matrix = [];
    for ($i = 0; $i < 2; $i++) {
        for ($j = 0; $j < 2; $j++) {
            $value = $adj_matrix[$i][$j];
            $inverse_matrix[$i][$j] = (($value % $mod + $mod) * $inv_det) % $mod;
        }
    }

    return $inverse_matrix;
}

function det($matrix)
{
    return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
}

function hill_cipher($text, $key, $mode)
{
    $mod = 26;
    $text = str_replace(" ", "", strtoupper($text));
    $text_len = strlen($text);

    if ($text_len % 2 != 0) {
        $text .= "X";
    }

    $key_matrix = $key;
    $key_inverse = matrix_inverse($key_matrix, $mod);

    if ($mode === "decrypt") {
        list($key_matrix, $key_inverse) = array($key_inverse, $key_matrix);
    }

    $result = "";
    for ($i = 0; $i < $text_len; $i += 2) {
        $char_pair = [ord($text[$i]) - ord("A"), ord($text[$i + 1]) - ord("A")];
        $encrypted_pair = [0, 0];

        for ($j = 0; $j < 2; $j++) {
            for ($k = 0; $k < 2; $k++) {
                $encrypted_pair[$j] += $key_matrix[$j][$k] * $char_pair[$k];
            }
            $encrypted_pair[$j] = $encrypted_pair[$j] % $mod;
        }

        $result .= chr($encrypted_pair[0] + ord("A")) . chr($encrypted_pair[1] + ord("A"));
    }

    return $result;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hill";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        $email = ""; // Default value
    }
    $text = $_POST["text"]; 
    $key = json_decode($_POST["key"]); 
    if (isset($_POST['encrypt'])) {
        $encrypted = hill_cipher($text, $key, "encrypt"); 
        
        $sql = "INSERT INTO enkrip (email, encrypted_key, encrypted_text)
        VALUES ('$email', '".json_encode($key)."', '$encrypted')";

        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        echo "Encrypted text: " . $encrypted . "<br>";
    }elseif (isset($_POST['update'])) {
        $id = $_POST["id"];
        $new_text = $_POST["new_text"];
        $new_email = $_POST["new_email"]; 
        $new_key = json_decode($_POST["new_key"]); 
        $new_encrypted = hill_cipher($new_text, $new_key, "encrypt"); 
    
        $sql = "UPDATE enkrip SET email = '$new_email', encrypted_key = '".json_encode($new_key)."', encrypted_text = '$new_encrypted' WHERE id = $id";
    
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully <br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }    
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        // Lakukan operasi delete hanya jika tombol delete ditekan
        if (isset($_POST["id"])) {
            // Periksa apakah kunci 'id' ada dalam $_POST sebelum mengaksesnya
            $id = $_POST["id"];

            // Lanjutkan dengan operasi delete
            $sql = "DELETE FROM enkrip WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully <br>";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }
}

$sql = "SELECT id, email, encrypted_key, encrypted_text FROM enkrip"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["encrypted_key"] . "</td>";
                echo "<td>" . $row["encrypted_text"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results.</td></tr>";
        }
        
$conn->close();

?>
