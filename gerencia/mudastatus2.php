<?php // session_start();
   //if (! $acesso)
   //   header("Location: index.htm");

   $db=mysql_connect("localhost","root","");
   mysql_select_db("sulpel", $db);
   
   $cmd = mysql_query("update sulpel_vendas set codstatus =
              $status where codigo = $cod");
              
   if ($cmd)
     echo "Ok! Altera��o de Status conclu�da";
   else
     echo "Erro... N�o alterado";
     
   mysql_close($db);
?>
<P ALIGN="RIGHT">
<A HREF="listavendas.php"> Voltar </A>
