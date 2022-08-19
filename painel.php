<?php 
session_start();
include('verifica_login.php');//chamando o arquivo
?>
<div align="right">
 <h3>Olá, <?php echo $_SESSION['usuario']; ?></h3>
</div>

<nav align="rigt">
    <!-- Link para encerrar a sessão do usuario -->
    <h3> <a href="login.php">sair</a> </h3>
    </nav>
    