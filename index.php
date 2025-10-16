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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bark Park - Dog Friendly Parks</title>
   
</head>
<body>

<header>
    <div class="site-name">Site name</div>
    <a href="#">Help</a>
</header>

<main>
    <h1>FIND PARKS</h1>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by park or location" value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Search">
    </form>

    <div class="map-box">
        Map
    </div>

    <div class="info-boxes">
        <div class="info-box">Off Leash Area</div>
        <div class="info-box">Water Stations</div>
        <div class="info-box">Walking Trails</div>
    </div>

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
</main>

<footer>
    <a href="#">Use Cases</a>
    <a href="#">Resources</a>
</footer>

</body>
</html>
