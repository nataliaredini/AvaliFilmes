<?php
include 'conexao.php';
header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idFilme'])) {
    $idFilme = $_POST['idFilme'];

    $stmt = $pdo->prepare("DELETE FROM filmes WHERE idFilme = ?");
    if ($stmt->execute([$idFilme])) {
        echo json_encode(["msg" => "Filme deletado com sucesso!"]);
    } else {
        echo json_encode(["msg" => "Erro ao deletar o filme."]);
    }
} else {
    echo json_encode(["msg" => "ID do filme não enviado."]);
}
?>