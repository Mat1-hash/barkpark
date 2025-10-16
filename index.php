<?php
include 'db.php';

// Handle search query
$search = "";
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $search = $conn->real_escape_string($search);
    $sql = "SELECT * FROM parks WHERE name LIKE '%$search%' OR location LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM parks";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bark Park - Dog Friendly Parks</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        input[type="text"] { padding: 6px; width: 300px; }
        input[type="submit"] { padding: 6px 12px; }
    </style>
</head>
<body>

<h1>Bark Park - Dog Friendly Parks</h1>

<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by park or location" value="<?php echo htmlspecialchars($search); ?>">
    <input type="submit" value="Search">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Location</th>
        <th>Leash</th>
        <th>Type</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            echo "<tr>
                    <td>".htmlspecialchars($row['name'])."</td>
                    <td>".htmlspecialchars($row['location'])."</td>
                    <td>".htmlspecialchars($row['leash'])."</td>
                    <td>".htmlspecialchars($row['type'])."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No parks found</td></tr>";
    }
    $conn->close();
    ?>
</table>

</body>
</html>
