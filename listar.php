<?php
    // 20 - estartando a sessão
     session_start();

    // 1 - Chamando a conexão com o banco de dados e a função conectar
    include("conexao.php");
    $conn=conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
</head>
<body>
    
    <h1>Listar Registros</h1>

    <!-- 19 - ISSET verificando se a SESSION 'cadastrado' existe -->
    <?php
            if(isset($_SESSION['cadastrado'])): //Como utilizei dois pontos nao preciso das chaves, mas preciso fechar com ENDIF;
        ?>

        <!-- Mensagem de usuário cadastrado -->
        <div class="notification is-danger">
            <p style="color:green">Usuário cadastrado com sucesso! </p>
        </div>
        
        <?php
            endif; //Fechando o IF
            //unset para Destruir uma session para nao mostrar no inicio do login.
            unset($_SESSION['cadastrado']); 
        ?>

 
    <?php

        /* 4 - Criar uma variável chamada page na barra de navegação e 
               atribuir através do método GET a uma variável no PHP,
               Para receber o número da página atual.

       */
            //Criar na URL a variavel page
            # localhost/sistemaaluno1/listar.php?page=1
      

        // 5 - Receber o número da página através da URL
        $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);

        //  6 - Verificando se o usuário não enviar a página pela URL, Se isso acontecer recebe pagina 1
        $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
         
        // 7 - Var_dump --> Para visualizar o número da página   
        #var_dump($pagina);  
        
        /* 8 - Setar a quantidade de registros por página
         Inicialmente vamos criar uma várivel para colocar 2 registros por página */
        $limite_resultado = 2;

        /* 9 - Calcular o inicio da visualização
        Precisamos identificar a partir de qual registro o usuário quer começar a visualizar*/
        $inicio = ($limite_resultado * $pagina) - $limite_resultado;

        // 10 - Agora vamos implementar na QUERY os limites da consulta "LIMIT $inicio $limite_resultao"

        /*-----------------------------------------------------------------------------------------------------------*/
        /* Testar no Browser para verificar se está mostrando o numero limitado de resgistros por página. Exempo: page=2*/
        /*-----------------------------------------------------------------------------------------------------------*/

        // 2 - Criando uma Consulta para Pesquisar usuarios no Banco de Dados
        $query_usuarios = "SELECT id, matricula, nome, email, estatus, dtcadastro FROM usuarios ORDER BY id DESC  LIMIT $inicio, $limite_resultado";
        $result_usuarios = $conn->prepare($query_usuarios);
        $result_usuarios->execute();

       

        // 3. Fase 3 - Para otimizar melhor a apresentação dos registros vamos utilizar o EXTRACT no ARRAY dentro do While
        if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)){ 
            
            while($rowusuarios = $result_usuarios->fetch(PDO::FETCH_ASSOC)){//fetch(PDO::FETCH_ASSOC) Retorna um array associativo. Nele o índice é o nome da coluna que está no BD
            
                extract($rowusuarios);
                echo "ID: $id <br>";
                echo "Matricula: $matricula <br>";
                echo "Nome: $nome <br>";
                echo "Email: $email <br>";
                echo "Estatus: $estatus <br>";
                echo "Data: " . date("d/m/Y H:i:s", strtotime($dtcadastro)) . "<br>"; // 23 - formatando a data 
                echo "<hr>";//Criando um linha para separar os registros   
            }

            /* 11 - Agora queremos colocar a paginação na parte inferir da página de visualização de registros
            Para isso precisamos contar a quantidade de registros no Banco de Dados*/

            //Contar a quantidade de registros no Banco de Dados
            $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM  usuarios ";  //SQL ALIAS (AS) no MySQL: usamos a cláusula AS dar um nome diferente (e mais amigável) a uma coluna ou tabela
            $result_qnt_registros = $conn->prepare($query_qnt_registros);
            $result_qnt_registros->execute();
            $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);//fetch(PDO::FETCH_ASSOC) Retorna um array associativo. Nele o índice é o nome da coluna que está no BD

            /* 12 - Agora que já sabemos a quantidade de registros no Banco de Dados
            Precisamos saber a quantidade de páginas. Para isso vamos utilizar a função CEIL*/
             //Quantidade de Páginas
             $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

            
             //16 - Criando a variável para informar Maximo de link na página
            $maximo_link = 2;

             /* 14 - Agora vamos implementar o link para a primeira página.*/
             //Mostrando o link: Primeira Página
             echo "<a href='listar.php?page=1'>Primeira</a> ";

             /*---------------------------------------------------------------------------------------*/
             //14 - Executar um Teste no Browser ver se está indo para a página 1 quando clicar no link "Primeira".
            /*----------------------------------------------------------------------------------------*/
             

            /* 17 - Agora vamos implementar duas paginas anterior a página atual. 
            Para isso vamos precisar de um FOR*/
            
            //For para listar duas páginas anteriores a página atual.
            for($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++){

                if($pagina_anterior >= 1){
                    echo "<a href='listar.php?page=$pagina_anterior'>$pagina_anterior</a> ";
                }
            }

            /*---------------------------------------------------------------------------------------*/
             //17 - Executar um Teste no Browser ver se está mostrando duas páginas anteriores a página atual.
            /*----------------------------------------------------------------------------------------*/

             /* 13 - Agora já podemos implementar a paginação. 
             Primeiro vamos mostrar em que página o usuário está.*/
             echo "$pagina ";

             /*------------------------------------------------------------------------*/
             //13 - Executar um Teste no Browser neste ponto para visualizar o numero da página impresso.
            /*------------------------------------------------------------------------*/

            /* 18 - Agora vamos implementar duas paginas Posterior a página atual. 
            Para isso vamos precisar também de um FOR*/
            
            //For para listas duas páginas posterior a página atual
            for($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++){
                if($proxima_pagina <= $qnt_pagina){
                    echo "<a href='listar.php?page=$proxima_pagina'>$proxima_pagina</a> ";
                }
            }

            /*---------------------------------------------------------------------------------------*/
             //18 - Executar um Teste no Browser ver se está mostrando duas páginas posterior a página atual.
            /*----------------------------------------------------------------------------------------*/

             //21 - Agora vamos no arquivo scriptcadastro.php, criar um redirecionamento
                //  para a página listar assim que for cadastrado um usuário.
            
                # header("Location:listar.php");

            // 22 - Agora vamos ordernar a consulta no "item 2" para mostrar em Ordem Decrescente,
                 // Mostrar pelo últimos usuários cadastrados
            
                # ORDER BY id DESC

            /* 15 - Agora vamos implementar o link para a última página.*/
             //Mostrando o link: Última Página
            echo "<a href='listar.php?page=$qnt_pagina'>Última</a> ";

            /*---------------------------------------------------------------------------------------*/
             //15 - Executar um Teste no Browser ver se está indo para a Última página quando clicar no link "Última".
            /*----------------------------------------------------------------------------------------*/

        }else{

            echo "<p style='color:red;'>Erro: Usuário não encontrado!</p>";
      
        }


    ?>
    
</body>
</html>