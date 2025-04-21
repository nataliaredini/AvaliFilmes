<?php
include 'conexao.php';
header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idFilme'])) {
    $idFilme = $_POST['idFilme'];

    $stmt = $conn->prepare("DELETE FROM filmes WHERE idFilme = ?");
    $stmt->bind_param("i", $idFilme);
    if ($stmt->execute()) {
        echo json_encode(["msg" => "Filme deletado com sucesso!"]);
    } else {
        echo json_encode(["msg" => "Erro ao deletar o filme."]);
    }
} else {
    echo json_encode(["msg" => "ID do filme não enviado."]);
}
?>