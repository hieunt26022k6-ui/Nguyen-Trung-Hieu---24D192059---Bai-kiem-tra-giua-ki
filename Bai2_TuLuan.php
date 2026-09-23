<?php

$hocSinh = array(
    array("id" => "HS01", "name" => "Nguyễn Văn An", "age" => 18, "grade" => 8.5),
    array("id" => "HS02", "name" => "Trần Thị Bình", "age" => 17, "grade" => 9.2),
    array("id" => "HS03", "name" => "Lê Minh Cường", "age" => 18, "grade" => 7.8),
    array("id" => "HS04", "name" => "Phạm Thu Dung", "age" => 17, "grade" => 9.6),
    array("id" => "HS05", "name" => "Hoàng Văn Em", "age" => 18, "grade" => 6.9)
);

function timDiemCaoNhat($danhSach) {
    $caoNhat = $danhSach[0];
    foreach ($danhSach as $hs) {
        if ($hs["grade"] > $caoNhat["grade"]) {
            $caoNhat = $hs;
        }
    }
    return $caoNhat;
}

$hocSinhGioiNhat = timDiemCaoNhat($hocSinh);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Quản lý học sinh</title>
</head>
<body>
<h1>Bài 2: Danh sách học sinh</h1>
<table border="1" cellpadding="6">
<tr>
    <th>ID</th>
    <th>Họ tên</th>
    <th>Tuổi</th>
    <th>Điểm</th>
</tr>
<?php
foreach ($hocSinh as $hs) {
    echo "<tr>";
    echo "<td>" . $hs["id"] . "</td>";
    echo "<td>" . $hs["name"] . "</td>";
    echo "<td>" . $hs["age"] . "</td>";
    echo "<td>" . $hs["grade"] . "</td>";
    echo "</tr>";
}
?>
</table>
<p>Học sinh có điểm cao nhất: <?php echo $hocSinhGioiNhat["name"] . " (" . $hocSinhGioiNhat["id"] . ") - " . $hocSinhGioiNhat["grade"] . " điểm"; ?></p>
</body>
</html>
