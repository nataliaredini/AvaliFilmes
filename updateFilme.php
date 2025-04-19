<?php
include 'conexao.php';

header('Content-type: application/json');

if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['diretor']) && isset($_POST['anoLancamento']) && isset($_POST['genero']) && isset($_POST['nota'])&& isset($_POST['comentario'])) {
    
    $id = intval($_POST['id']);
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $diretor = $conn->real_escape_string($_POST['diretor']);
    $anoLancamento = intval($_POST['anoLancamento']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $nota = floatval($_POST['nota']);
    $comentario = $conn->real_escape_string($_POST['comentario']);

   
    $stmt = $conn->prepare("UPDATE filmes SET titulo = ?, diretor = ?, anoLancamento = ?, genero = ?, nota = ?, comentario = ? WHERE id = ?");
    $stmt->bind_param("ssissi", $titulo, $diretor, $anoLancamento, $genero, $nota, $comentario, $id);


    if ($stmt->execute()) {
        $msg = "Filme atualizado com sucesso!";
    } else {
        $msg = "Erro: " . $stmt->error;
    }


    $stmt->close();
} else {
    $msg = "Erro: Dados insuficientes para atualizar o filme.";
}


$conn->close();
