<?php
class Usuario{
    public $idUsuario,$nome, $login, $senha;
    
    function __construct( $idUsuario, $nome, $login, $senha){
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->login = $login;
}

function validaUsuarioSenha($login, $senha){
    if($login ==  $this->login &&  $senha ==  $this->senha){
        return true;
    }
    return false;
}
}
?>