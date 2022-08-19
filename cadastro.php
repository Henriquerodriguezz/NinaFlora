<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nina Flora Cosméticos</title>
    <link rel="shortcut icon" href="img/nina.png">
    <link rel="stylesheet"  href="css/stylecad.css">
   
    </style>
</head>
<body>
    <!--Criando o Cabeçalho da Página-->
       <header class="cabecalho">
        <div id="cabecalho">
            
            <div id="logo">
                <a href="index.php"> <img src="img/nina.png"></a>
            </div>

            <div id="titulo1">
                <h2>Cadastrar Revendedores</h2>
            </div>

        </div>
    </header>


    <!--Criando a Sessão Principal da Página-->
    <div class="conteudo">

    
        <section class="container">
            <p class="titulo2">Preencha os campos obrigatórios <label>*</label></p>

            <br/>
            <br/>
            <!--Verificando se a sessão cadastrado existe - ISSET -->
            <?php

                if(isset($_SESSION['cadastrado'])):
                    echo "saido if cadastrado"
            ?>
            <!--mensagem de usuário cadastrado-->
            <div class="notification is-danger" align="center">
                <p style='color:green'>Usuário cadastrado com sucesso!</p>
            </div>

            <?php
                endif; //fechando o IF
                //Função para destruir uma sessão
                unset($_SESSION['cadastrado']);
            ?>

            <?php
                if(isset($_SESSION['nao_cadastrado'])):
            ?>
            <!--mensagem de usuário não cadastrado-->
            <div class="notification is-danger" align="center">
                <p style='color:#f00'>Erro:e-mail já cadastrado</p>
            </div>

            <?php
                endif; //fechando o IF
                //Função para destruir uma sessão
                unset($_SESSION['nao_cadastrado']);
            ?>


            <!--Início do formulário-->
            <form name="cadninaflora" action="scriptcadastro.php" method="POST" id="form-cadastro">
                
                <!--Criando os inputs-->
                <div>
                    Matricula: <label>*</label>
                    <input type="text" name="mat" placeholder="Digite sua Matricula" required>
                </div>
                <div>
                    Nome completo: <label>*</label>
                    <input type="text" name="nome" placeholder="Digite seu nome completo" required>
                </div>

                <div>
                    CPF: <label>*</label>
                    <input type="cpf" name="cpf" placeholder="Digite seu CPF" required>
                </div>
                
                <div>
                    E-mail: <label>*</label>
                    <input type="email" name="email" placeholder="Digite o seu melhor email" required>
                </div>

                <div>
                    Senha: <label>*</label>
                    <input type="password" name="senha" placeholder="Cadastre uma senha forte" required>
                </div>

                <!--Criando uma lista de seleção de status com o SELECT-->
                <p>Status: <label>*</label></p>
                <div>
                    <select name="estatus">
                        <option value="">Selecione uma opção</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>

                <P>Usuário: <label>*</label></P>
                <div>
                    <select name="painel">
                        <option value="">Selecione uma opção</option>
                        <option value="administrador">Administrador</option>
                        <option value="professor">Revendedor</option>                      
                    </select>
                </div>

                <!--Criando os botões-->
                <div class="botao">
                    <button type="submit">Cadastrar</button>
                    <button type="reset">Limpar</button>
                </div>
            </form><!--Fím do Formulário-->

        </section><!--Fím da sessão principal-->
    </div>

    <footer class="rodape"><!--Início do Rodapé-->
        <p>DADOS DE CONTATO (92) 3347-1498 
        Rua Barão do Rio Branco, 1333 Lj 10 - Parque das Laranjeiras - Flores
        ninaflora@ninaflora.com</p>
    </footer><!--Fím do radapé-->
    
</body>
</html>