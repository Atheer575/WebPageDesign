<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            background: #fff;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        input[type=text], input[type=number] {
            padding: 6px;
            width: 150px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type=submit] {
            padding: 6px 12px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background: #0056b3;
        }
        table {
            margin-top: 30px;
            background: white;
            border-collapse: collapse;
            width: 600px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background: #007BFF;
            color: white;
        }
        button {
            padding: 4px 8px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <h2>Student Form</h2>

    <form id="studentForm" method="POST" action="insert.php">
        <input type="text" name="name" id="name" placeholder="Name">
        <input type="number" name="age" id="age" placeholder="Age">
        <input type="submit" value="Submit">
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        $conn = new mysqli("localhost", "root", "", "student_db");
        $result = $conn->query("SELECT * FROM students");

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['age']."</td>";
            echo "<td id='status-".$row['id']."'>".$row['status']."</td>";
            echo "<td><button onclick='toggleStatus(".$row['id'].")'>Toggle</button></td>";
            echo "</tr>";
        }

        $conn->close();
        ?>
    </table>

    <script>
        function toggleStatus(id) {
            fetch('toggle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('status-' + id).innerText = data;
            });
        }
    </script>

</body>
</html>
