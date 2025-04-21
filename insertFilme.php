<?php
include 'conexao.php';

header('Content-type: application/json');


if (isset($_POST['titulo']) && isset($_POST['diretor']) && isset($_POST['anoLancamento']) && isset($_POST['genero']) && isset($_POST['nota'])&& isset($_POST['comentario'])) {
  
    $sql = "INSERT INTO filmes (titulo, diretor, anoLancamento, genero, nota, comentario) VALUES (
        '" . $conn->real_escape_string($_POST['titulo']) . "',
        '" . $conn->real_escape_string($_POST['diretor']) . "',
        " . intval($_POST['anoLancamento']) . ",
        '" . $conn->real_escape_string($_POST['genero']) . "',
        " . floatval($_POST['nota']) . ",
        '" . $conn->real_escape_string($_POST['comentario']) . "'
    )";



    if ($conn->query($sql) === TRUE) {
        $msg = "Filme criado com sucesso!";
    } else {
        $msg = "Erro: " . $sql . "<br>" . $conn->error;
    }
} else {
    $msg = "Erro: Dados insuficientes para criar o filme.";
}

$conn->close();


echo json_encode(['msg' => $msg]);
?>