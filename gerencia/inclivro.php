<?php
  session_start();
  $acesso = $_SESSION["acesso"];
  if (! $acesso)
    header("Location: index.htm");
?>
<HTML>
<HEAD>
<TITLE> SULPEL INFORM�TICA </TITLE>
</HEAD>
<BODY>
<CENTER><FONT FACE="TAHOMA"><B> Inclus�o de Produtos <P>
<FORM METHOD="POST" enctype="multipart/form-data" ACTION="inclivro2.php">
Produto: <INPUT TYPE="TEXT" SIZE=30 NAME="titulo"><P>
Descri��o:  <INPUT TYPE="TEXT" SIZE=30 NAME="autor"><P>
Pre�o:  <INPUT TYPE="TEXT" SIZE=12 NAME="preco"><P>
Foto:   <INPUT TYPE="FILE" NAME="foto" VALUE="Selecionar"><P>
<INPUT TYPE="SUBMIT" VALUE="Enviar"> <P>
</FORM>
<P ALIGN="RIGHT"> <A HREF="menu.php"> Menu </A>
</BODY>
</HTML>
