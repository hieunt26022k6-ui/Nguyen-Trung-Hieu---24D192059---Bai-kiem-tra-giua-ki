<?php

/*
 * BÀI 2: QUẢN LÝ THÔNG TIN HỌC SINH SỬ DỤNG DATABASE (MySQL + PDO)
 */
const DB_HOST     = '127.0.0.1';
const DB_PORT     = '3306';
const DB_NAME     = 'quan_ly_hoc_sinh';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

function taoKetNoiDatabase() {
    $tuyChonPDO = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    );
    $chuoiKetNoi = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=utf8mb4";
    return new PDO($chuoiKetNoi, DB_USERNAME, DB_PASSWORD, $tuyChonPDO);
}

function layDanhSachHocSinh($ketNoi) {
    $danhSach = array();
    $dem = 0;
    $cauLenh = $ketNoi->prepare("SELECT id, name, age, grade FROM hoc_sinh ORDER BY id");
    $cauLenh->execute();
    while ($hang = $cauLenh->fetch()) {
        $danhSach[$dem] = $hang;
        $dem++;
    }
    return $danhSach;
}

function timDiemCaoNhat($danhSach) {
    $caoNhat = $danhSach[0];
    foreach ($danhSach as $hs) {
        if ($hs["grade"] > $caoNhat["grade"]) {
            $caoNhat = $hs;
        }
    }
    return $caoNhat;
}

function taoDuLieuMau($ketNoi) {
    $ketNoi->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4");
    $ketNoi->exec("USE " . DB_NAME);
    $ketNoi->exec("CREATE TABLE IF NOT EXISTS hoc_sinh (id VARCHAR(10) PRIMARY KEY, name VARCHAR(50) NOT NULL, age INT NOT NULL, grade FLOAT NOT NULL)");

    $danhSach = layDanhSachHocSinh($ketNoi);
    $dem = 0;
    foreach ($danhSach as $hs) {
        $dem++;
    }
    if ($dem == 0) {
        $duLieu = array(
            array("HS01", "Nguyễn Văn An", 18, 8.5),
            array("HS02", "Trần Thị Bình", 17, 9.2),
            array("HS03", "Lê Minh Cường", 18, 7.8),
            array("HS04", "Phạm Thu Dung", 17, 9.6),
            array("HS05", "Hoàng Văn Em", 18, 6.9)
        );
        $cauLenh = $ketNoi->prepare("INSERT INTO hoc_sinh (id, name, age, grade) VALUES (?, ?, ?, ?)");
        foreach ($duLieu as $hs) {
            $cauLenh->execute($hs);
        }
    }
}

$ketNoi = taoKetNoiDatabase();
taoDuLieuMau($ketNoi);
$hocSinh = layDanhSachHocSinh($ketNoi);
$hocSinhGioiNhat = timDiemCaoNhat($hocSinh);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Quản lý học sinh (MySQL + PDO)</title>
</head>
<body>
<h1>Bài 2: Danh sách học sinh</h1>
<p>Dữ liệu lấy từ database <b><?php echo DB_NAME; ?></b>, bảng <b>hoc_sinh</b>.</p>
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
