<?php
  if (isset($nomecli))
   {
    // nome = Luis Carlos Silva
    // nome[0] = Luis
    // nome[1] = Carlos
    $nome    = explode(" ", $nomecli);
    $prinome = $nome[0];
    echo "Ol� $prinome, Seja Bem-Vindo (Se n�o for voc�
         <A HREF=identificacli.php> Clique Aqui </A>";
   }
  else
   {
    echo "Bem-Vindo! Identifique-se
         <A HREF=identificacli.php> Clicando Aqui </A>";
   }
?>
