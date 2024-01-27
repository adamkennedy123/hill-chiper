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
    <form id="updateForm" method="post">
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>
    
    <label for="key">Key:</label>
    <textarea name="key" id="key" rows="2"></textarea><br>
    
    <label for="text">Text:</label>
    <textarea name="text" id="text" rows="4"></textarea><br>
    
    <input type="submit" name="encrypt" value="Create">
    <input type="submit" value="Option" onclick="submitToAnotherPage()">
    <input type="reset" value="Clear">
</form>

<script>
    function submitToAnotherPage() {
        document.getElementById("updateForm").action = "option.php";
        document.getElementById("updateForm").submit();
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
