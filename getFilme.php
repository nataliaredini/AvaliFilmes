<?php
include 'conexao.php'; 

$ini = isset($_GET['page']) ? ($_GET['page'] - 1) * 10 : 0;

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';


$totalResult = $conn->query("SELECT COUNT(*) FROM filmes WHERE titulo LIKE '%" . $filtro . "%'");
$total = mysqli_fetch_array($totalResult);


$sql = "SELECT * FROM filmes WHERE titulo LIKE '%" . $filtro . "%' ORDER BY idFilme ASC LIMIT " . $ini . ", 10";
$result = $conn->query($sql);


$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);


$conn->close();


header('Content-type: application/json');
echo json_encode(['data' => $rows, "total" => $total[0]]);