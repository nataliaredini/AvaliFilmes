<?php
include 'conexao.php';

header('Content-type: application/json');

if (isset($_POST['idFilme']) && isset($_POST['titulo']) && isset($_POST['diretor']) && isset($_POST['anoLancamento']) && isset($_POST['genero']) && isset($_POST['nota'])&& isset($_POST['comentario'])) {

    
    $idFilme = intval($_POST['idFilme']);
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $diretor = $conn->real_escape_string($_POST['diretor']);
    $anoLancamento = intval($_POST['anoLancamento']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $nota = floatval($_POST['nota']);
    $comentario = $conn->real_escape_string($_POST['comentario']);

   
    $stmt = $conn->prepare("UPDATE filmes SET titulo = ?, diretor = ?, anoLancamento = ?, genero = ?, nota = ?, comentario = ? WHERE idFilme = ?");
    $stmt->bind_param("ssisssi", $titulo, $diretor, $anoLancamento, $genero, $nota, $comentario, $idFilme);

    if ($stmt->execute()) {
        $msg = "Filme atualizado com sucesso!";
    } else {
        $msg = "Erro: " . $stmt->error;
    }


    $stmt->close();
} else {
    $msg = "Erro: Dados insuficientes para atualizar o filme.";
    print "oi";
}


$conn->close();


echo json_encode(['msg' => $msg]);
?>