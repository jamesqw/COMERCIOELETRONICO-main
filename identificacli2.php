<?php
  $db = mysql_connect("localhost",
                      "trab2", "");
  mysql_select_db("sulpel", $db);
  $dados = mysql_query("select * from sulpel_clientes
           where email = '$email' and senha = '$senha' ");
  if (mysql_num_rows($dados) == 1)
   {
     $linha = mysql_fetch_array($dados);
     $nome  = $linha["nome"];
    // $nome = "Jos� Carlos";
     // Grava um cookie:
     // nome do cookie, conte�do, tempo de dura��o
     setcookie("nomecli", $nome, time()+100000);
    // header("Location: ../topo.php");
     echo "<script> window.parent.location.href='../sulpel/index.php'; </script>";
   }
  else
     echo "Erro. Dados Inv�lidos";
?>
