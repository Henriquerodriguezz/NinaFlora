<?php
//Script para conectar com o Banco de Dados com PDO

//Criando uma função para utilizar em outros arquivos
function conectar(){

//Tratando Excessões com Try/catch
    try{
        $conn = new PDO("mysql:host=localhost; dbname=ninaflora", "root", "");
    }catch(PDOException $e){
        die('Não foi possível conectar com o banco de dados');
    }
        return $conn;//Retorna a variável de conexão
}
?>