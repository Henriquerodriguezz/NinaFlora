<?php
//Start na sessão
session_start();

//Chamando a conexão com o banco de dados
include("conexao.php");
$conn=conectar();

//Recuperando os dados do formulário com o metodo POST
$mat = $_POST['mat'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = MD5($_POST['senha']);
$estatus = $_POST['estatus'];
$painel = $_POST['painel'];


//Preparando os dados com pseudo-nome para enviar ao banco de dados
$cadastro = $conn->prepare("INSERT INTO usuarios(matricula, nome, cpf, email, senha, estatus, painel) 
 VALUES(:matricula, :nome, :cpf, :email, :senha, :estatus, :painel)");

//Passando os valores das variáveis para os pseudo-nomes através do método bindValue
$cadastro->bindValue(":matricula", $mat);
$cadastro->bindValue(":nome", $nome);
$cadastro->bindValue(":cpf", $cpf);
$cadastro->bindValue(":email", $email);
$cadastro->bindValue(":senha", $senha);
$cadastro->bindValue(":estatus", $estatus);
$cadastro->bindValue(":painel", $painel);

//Verificando se já existe um e-mail cadastrado
$verificar=$conn->prepare("SELECT * FROM usuarios WHERE email=?");
$verificar->execute(array($email));


if($verificar->rowCount()==0):
    //Executando o cadastro com a função execute()
    $cadastro->execute();
    echo "Usuario cadastrado com sucesso!";
else:
    echo "E-mail já cadastrado";
endif;

//Armazenando em uma variavel o retorno de um cadastro no banco de dados.
$row=$cadastro->rowCount();
if($row == 1){
    $_SESSION['cadastrado'] = true;
    header('Location:listar.php');//Redirecionando para a pagina listar
    //header('Location: cadastro.php');
    exit();
}
else{
    $_SESSION['nao_cadastrado'] = true;
    header('Location: cadastro.php');
    exit();
}

?>