<?php
include_once './conexao.php';
include_once './usuario.php';
session_start();

if (!isset($_SESSION['user'])){
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!";
    header("Location: index.login.php");
    exit;   
}

$idUsuario = $_SESSION['user']->idUsuario;

if (isset($_POST['titulo']) && isset($_POST['diretor']) && isset($_POST['anoLancamento']) && isset($_POST['genero']) && isset($_POST['nota']) && isset($_POST['comentario'])) {
  
 
    $sql = "INSERT INTO filmes (titulo, diretor, anoLancamento, genero, nota, comentario, idUsuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
  
    $stmt->bind_param(
        "ssisdsi", 
        $_POST['titulo'],
        $_POST['diretor'],
        $_POST['anoLancamento'],
        $_POST['genero'],
        $_POST['nota'],
        $_POST['comentario'],
        $idUsuario
    );


    if ($stmt->execute()) {
        $msg = "Filme criado com sucesso!";
    } else {
        $msg = "Erro: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    $msg = "Erro: Dados insuficientes para criar o filme.";
}

$conn->close();
echo json_encode(['msg' => $msg]);
?>