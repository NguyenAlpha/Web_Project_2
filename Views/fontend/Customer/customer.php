<?php
include(__DIR__ . '/../../../Database.php');


$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

echo "<h2>Danh sách khách hàng</h2>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Tên</th><th>Email</th><th>SĐT</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Không có khách hàng nào</td></tr>";
}

echo "</table>";
$conn->close();
?>