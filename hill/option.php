<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hill Cipher CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Hill Cipher CRUD</h2>
    
    <!-- Form for Create, Update, and Delete -->
    <form id="FormAwal" method="post">
    <label for="id">id:</label>
    <input type="text" name="id" id="id"><br>
    
    <label for="new_email">Email:</label>
    <input type="email" name="new_email" id="new_email"><br>
    
    <label for="new_key">Key:</label>
    <textarea name="new_key" id="new_key" rows="2"></textarea><br>
    
    <label for="new_text">Text:</label>
    <textarea name="new_text" id="new_text" rows="4"></textarea><br>
    
    <input type="submit" name="update" value="Update">
    <input type="reset" value="Clear">
    <input type="submit" value="Back" onclick="submitkefileLain()">
</form>
<form method="post">
        <input type="hidden" name="delete">
        <label for="id">id:</label>
        <input type="text" name="id" id="id"><br>
        <input type="submit" value="Delete">
    </form>
<script>
    function submitkefileLain() {
        document.getElementById("FormAwal").action = "hil.php";
        document.getElementById("FormAwak").submit();
    }
</script>
<table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Key</th>
            <th>Text</th>
        </tr>

        <?php
        include('hill.php');
        ?>
    </table>
    
</body>
</html>
