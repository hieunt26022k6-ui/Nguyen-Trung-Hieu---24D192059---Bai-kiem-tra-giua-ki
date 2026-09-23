<?php

function generateFibonacci(int $n) {
    $daySo = array();
    $truoc = 0;
    $sau = 1;
    for ($i = 0; $i < $n; $i++) {
        $daySo[$i] = $truoc;
        $tong = $truoc + $sau;
        $truoc = $sau;
        $sau = $tong;
    }
    return $daySo;
}

$n = 10;
$daySo = generateFibonacci($n);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài 1 - Dãy số Fibonacci</title>
</head>
<body>
<h1>Bài 1: Dãy số Fibonacci</h1>
<p>Dãy số Fibonacci đầu tiên có <?php echo $n; ?> phần tử:</p>
<table border="1" cellpadding="6">
<tr>
    <th>Vị trí</th>
    <th>Giá trị</th>
</tr>
<?php
for ($i = 0; $i < $n; $i++) {
    echo "<tr>";
    echo "<td>" . ($i + 1) . "</td>";
    echo "<td>" . $daySo[$i] . "</td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>
