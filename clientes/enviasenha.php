<?
  $db = mysql_connect("mysql02.trab.com.br","trab2", "comercio1030");
  mysql_select_db("trab2", $db);

  $dados = mysql_query("select * from sulpel_clientes where
                        email = '$email' ");
                        
  $linha = mysql_fetch_array($dados);
  
  $nome  = $linha["nome"];
  $senha = $linha["senha"];
  
  $mensagem = "Prezado Sr(a) $nome \n\n";
  $mensagem = $mensagem . "Conforme solicitado em sua visita\n";
  $mensagem = $mensagem . "ao site da Sulpel Inform�tica, \n";
  $mensagem = $mensagem . "estamos lhe enviando sua senha.\n\n";
  
  $mensagem = $mensagem . "Senha: $senha";

  // envia mensagem
  mail("$email", "Senha: Sulpel Inform�tica", "$mensagem",
       "From: andregds85@gmail.com");

  echo "Em breve voc� estar� recebendo um e-mail com sua senha";

  mysql_close($db);
?>
  
  
  
  
  
