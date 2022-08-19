<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nina Flora Cosméticos</title>
    <link rel="stylesheet" href="css/stylelogin.css">
    <link rel="shortcut icon" href="img/nina2.png">

</head>
<body>
    <div class="conteudo">
    <section  class="content-center"> 
       
            <!--logo que fica na caixa de login-->
            <div class="logo"> 
            <a href="index.php"> <img src="img/nina6.png"></a>
             </div>

        <h1 class="titulo2">bem-vindo</h1>

        <!--Verificando se a sessão existe - ISSET-->
        <?php
            if(isset($_SESSION['nao_autenticado'])):
        ?>
        <!--Criando uma mensagem de erro-->
        <div class="notification is-danger" align="center">
            <p style="color:red">Erro: Usuário ou senha inválidos.</p>
        </div>

        <?php
            endif;//Fechando o IF de teste

            //Destruindo a sessão 'nao_autenticado'
            unset($_SESSION['nao_autenticado']);
        ?>

                                                 <!--Início do formulario-->
        <form action="scriptlogin.php" method="POST" id="form-login">
        
                <Div>
                    <label>Login<br></label>
                    <input type="email" name="email" placeholder="E-mail do Usuário"> <!--Criando o campo email-->
                </Div>

                <Div>
                    <label>Senha <br></label>
                    <input type="password" name="senha" placeholder="Senha"> <!--Criando o campo senha-->
                </Div>

                <!--Criando o botão Entrar -->
                <div class="botao">
                    <button type="submit">Entrar</button> <br>  
                </div>
                <!-- -------------------------------->

        </form>
                                                <!--Fim do formulário-->
        <!-- botão cadastrar-se -->
            <div class="botao">
            <a href="cadastro.php"> <button >cadastrar-se</button></a>
            </div>
            <!-- --------------------->
           
    </section>
      
    
    
    


    </div>


    <footer class="footer-content">
        <h2> <h1 class="titulo1">Empresa totalmente Amazonense!</h1></h2>
        <p>Opções de serviço: Compras na loja · Retirada na loja · Entrega AM</p>
        <p>Endereço: R. Barão do Rio Branco, 133 - Sala 10 Qdra 38 - Flores, Manaus - AM, 69058-581</p>
    </footer>
    
</body>
</html>