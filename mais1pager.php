<?
##############################
##      Pagina��o f�cil     ##
##     Desenvolvido por:    ##
##        Robert_Rsc        ##
##############################
##
## Totalmente remodelado 
## por BobFrank
## rsfranc@yahoo.com.br
## agosto/2003 
##                          
##############################

// ATEN��O ESTE SCRIPT � PARA USO LIVRE EM QUALQUER APLICA��O FOI 
// DESENVOLVIDO COM A AJUDA DE OUTROS SCRIPTS DE C�DIGO ABERTO - 
// VOC� PODE ALTER�-LO E UTILIZA-LO DA MANEIRA  QUE QUIZER MAS POR 
// FAVOR MANTENHA OS CR�DITOS - CASO VC UTILIZE ESTE SCRIPT POR FAVOR 
// ME ENVIE UM E-MAIL PARA ME NOTIFICAR DO USO. 
// [ Robert_Rsc ]

// Fique a vontade galera o script est� aqui para usar e aperfei�oar
// Este script esta bem customizado e com duas fun��es:
// navipages() - barra de navega��o nos resultados
// infopages() - barra de info de p�gina atual/total de pgs. e registros
// O miolo, que chamo de grid de resultados � onde voc� tem a liberdade
// de criar colocando os campos e html.
// Deixei 3 exemplos de grid, 2 comentados e o que esta ativo � um
// que apresenta 2 registros por linha da tabela.
// Seria muito legal se voc� criar seu grid original e mandar-me uma
// c�pia, assim a gente faria v�rios templates de grid para este scritp
// Esta vers�o � para MySQL, mas tamb�m tenho para AdoDB que � a
// melhor classe de abstra��o de databases que conhe�o para o PHP.
// Com a AdoDB (que conecta com quase todos os databases do mercado) na
// verdade nem precisa deste script, porque tem uma classe que gera o
// grid de pagina��o autom�tico. Mas mesmo assim teria que mexer muito
// na classe para fazer algo diferente. Assim acho que este paginador
// ajuda porque d� liberdade at� para os iniciantes.
// Um abra�o! Deus � Tudo-em-tudo!
// [ BobFrank ]
//
// Veja este script em funcionamento aqui:
// http://www.conflito.com.br/biblia/mais1pager.php
// rsfranc@yahoo.com.br
//
//#####################################################################
//ALTERE AS DEFINI�OES ABAIXO 
# Database MySQL (ou include dados de sua conex�o)
$endereco = "localhost";  		// ENTRE COM O HOST DO BANCO DE DADOS
$usuario  = "root";          	// NOME DE USU�RIO DO MYSQL
$password = "";          		// SENHA DO MySQL
$banco    = "sulpel";        	// NOME DO BANCO DE DADOS

$tabela   = "sulpel_prod";  					// TABELA DO DATABASE
$urlhomepage = "mais1pager.php";	    // LINK PARA SE $home=1

$nrows       = 8;               // RESULTADOS POR P�GINA
$nlinks      = 10;              // LINKS DE PAGINA POR P�GINA
$corbarra    = "orange";	    // COR DA BARRA
$w_barra     = "80%";		    // WIDTH BARRA
$corletra    = "#FFFFFF";	    // COR DA LETRA NA BARRA
$sizeletra   = "2";				// SIZE DA LETRA NA BARRA
$fontletra   = "Verdana";       // FONT DA LETRA NA BARRA
$barborder   = "0";				// BORDAS DAS BARRAS
$gridborder  = "1";				// BORDAS DO GRID DE RESULTADOS

// APRESENTE A SUA QUERY AQUI:
$sqlfrase  = "SELECT * FROM $tabela WHERE capitulo=1 AND versiculo=1";
$sqlfrase  = "SELECT * FROM $tabela";

//#####################################################################

//<-- Inicializa��o de variaveis - N�o mude nada aqui -->
$arquivo = $PHP_SELF."?r=1";
if (!isset($id))
{
  $param = 0;
  $id	 = 0; 
  $temp  = 0; 	  
} 
else 
{
  $temp   = $id;
  $passo1 = $temp - 1;
  $passo2 = $passo1*$nrows;
  $param  = $passo2;
}
$conexao   = mysql_connect("$endereco", "$usuario", "$password");
$sqllimit  = $sqlfrase . " LIMIT $param,$nrows";
$rs1       = mysql_db_query("$banco", "$sqlfrase", $conexao);
$rs2       = mysql_db_query("$banco", "$sqllimit", $conexao);
$totreg    = mysql_num_rows($rs1);
$limitreg  = mysql_num_rows($rs2);
$reg_final = $param + $limitreg;
$result_div = $totreg/$nrows;
$n_inteiro = (int)$result_div;
if ($n_inteiro < $result_div) 
{
	$n_paginas = $n_inteiro + 1;
}
else 
{
	$n_paginas = $result_div;
}
$pg_atual    = $param/$nrows+1;
$pg_anterior = $pg_atual - 1;
$pg_proxima  = $pg_atual + 1;
$lnk_impressos = 0;
//<-- final inicializa��o de variaveis -->

//<-- Pagina��o dos resultados -->
?>
<html>
<head>
<title></title>
<style type="text/css">A {color:white;}</style>
</head>
<body>
<?
	# barra navega��o com links p�ginas
	navipages($home=1,$center=1); 
?>

<!-- inicio do grid dos resutados da busca -->
<?
### MODELE O GRID DE RESULTADOS CONFORME SUA NECESSIDADE
?>
<TABLE BORDER="<?=$gridborder;?>" WIDTH="<?=$w_barra;?>" RULES=GROUPS  FRAME=BOX>

<COLGROUP SPAN=4>
<!-- Titulos de colunas (Mude para as colunas da sua tabela) -->
<tr>	
<td width=3%>Livro</td>
<td width=3%>Cp.</td>
<td width=3%>Vs.</td>
<td>Texto</td>
<!-- Para modo 1 registro por linha retire as 4 linhas abaixo -->
<td width=3%>Livro</td>
<td width=3%>Cp.</td>
<td width=3%>Vs.</td>
<td>Texto</td>
<!-- Nao retire o </tr>  -->
</tr>
<!-- Fim dos t�tulos -->
</COLGROUP>

<?
$i=0;
$record = array();
while($rs = mysql_fetch_array($rs2)) 
{ 	
	/*
	# um modelo sem table 1 registro por linha (descomente se desejar)		
	print htmlspecialchars($rs[0])." "
		.htmlspecialchars($rs[1])." "
		.htmlspecialchars($rs[2])." - "
		.htmlspecialchars($rs[3])." - "
		.htmlspecialchars($rs[4])."<br>";
	*/
	
		
	/*
	# um modelo table 1 registro por linha (descomente se desejar)
	?>
	<div align="left">
	<table border="<?=$gridborder;?>" width="100%"><tr>	
	<td width=5%><?=htmlspecialchars($rs[0]);?></td>
	<td width=3%><?=htmlspecialchars($rs[1]);?></td>
	<td width=3%><?=htmlspecialchars($rs[2]);?></td>
	<td width=3%><?=htmlspecialchars($rs[3]);?></td>
	<td><?=htmlspecialchars($rs[4]);?></td>
	</tr></table>
	</div>
	<?
	*/
	
	/*	
	# modelo 2 registros lado a lado
	if($i%2==0)
	{
		?><tr><?
	}
	?>	
	<td width=4% valign=top align=center><?=htmlspecialchars($rs[1]);?></td>
	<td width=3% valign=top align=center><?=htmlspecialchars($rs[2]);?></td>
	<td width=3% valign=top align=center><?=htmlspecialchars($rs[3]);?></td>
	<td valign=top><?=htmlspecialchars($rs[4]);?></td>
	<?
	if($i%2!=0)
	{
		?></tr><?
	}
	$i=$i+1;
	*/
	
	# modelo 2 registros lado a lado como um livro
	# cria array	
	$record[] = "<td width=4% valign=top align=center>".htmlspecialchars($rs[1])."</td>"
	   	       ."<td width=3% valign=top align=center>".htmlspecialchars($rs[2])."</td>"
		       ."<td width=3% valign=top align=center>".htmlspecialchars($rs[3])."</td>"
			   ."<td valign=top>".htmlspecialchars($rs[4])."</td>";
}
# modelo 2 registros lado a lado como um livro
# imprime resultados	
for($i=0;$i<((int)$nrows/2);$i++)
{
	$x=$i+(int)$nrows/2;
	print "<tr>".$record[$i].$record[$x]."</tr>";	
}
### FINAL DAS ALTERA��ES DO GRID
?>
</td></tr></table>
<!-- final do grid de resutados -->

<?
	# barra num.pag/tot.paginas e reg/tot.registros
	infopages(); 
?>
</body>
</html>
<!-- final -->


<!-- Fun��es - n�o � necessario alterar nada nestas fun��es -->
<?
## Functions navipages() e infopages() 
## troque as fun��es de posi��o caso queira que a barra de baixo
## fique acima e vice-versa.

# navipages()
# Controles e links para navegar pelas p�ginas de resultados
# Aceita os argumentos $home e $center com valores diferente de zero para
# colocar um bot�o home na barra ou centralizar
function navipages($home=0,$center=0)
{
	global $corbarra, 
		   $w_barra, 
		   $corletra, 
		   $sizeletra, 
		   $fontletra, 
		   $pg_atual, 
		   $pg_anterior,
		   $pg_proxima,  
		   $n_paginas, 
		   $reg_final, 
		   $totreg, 
		   $temp, 
		   $nlinks, 		   
		   $lnk_impressos, 		   
		   $arquivo, 
		   $id,
		   $urlhomepage,
		   $barborder;	
	
	if($center!=0)
	{
		echo "<center><div align='center'>";
	}	   
	else
	{
		echo "<div align='left'>";
	}
	?>		
	<table border="<?=$barborder;?>" cellspacing="0" cellpadding="0" bgcolor="<?=$corbarra;?>" width="<?=$w_barra;?>">
	<tr><td>
	<?
	if($home!=0)
	{
		?>
		<font face="Verdana" size="2" color="<?=$corletra;?>">
		<a href="<?=$urlhomepage;?>">
		<!--<img src="buttom/home.gif" border=0>-->
		Home
		</a>
		&nbsp;
		</font>
		<?
	}
	?>	
	<font face="<?=$fontletra;?>" size="<?=$sizeletra;?>" color="<?=$corletra;?>">
	<?
	if ($id > 1) 
	{
 		?>
 		<a href="<?echo $arquivo?>&id=1">
   		<!--<img src="buttom/primeiro.gif" border=0 height=20 width=40>-->
   		|<   		
   		</a>
   		&nbsp;
   		<a href="<?echo $arquivo?>&id=<?echo $pg_anterior;?>">
   		<!--<img src="buttom/esquerda.gif" border=0 height=20 width=40>-->
   		<<
   		</a>
   		<?
	}?>
	</font>
	<?
	if ($temp >= $nlinks)
	{
		if ($n_paginas > $nlinks) 
		{
			$n_maxlnk = $temp + 4;
	        $nlinks   = $n_maxlnk;
    	    $n_start  = $temp - 6;
    	    if($n_start==-1)
    	    {
	    	    $n_start=0;
    		}
        	$lnk_impressos = $n_start;
    	}
	}
	while(($lnk_impressos < $n_paginas) and ($lnk_impressos < $nlinks))
	{ 
    	$lnk_impressos ++;
    	?>
      	<font face="<?=$fontletra;?>" size="<?=$sizeletra;?>" color="<?=$corletra;?>">       	
        <?
        if ($pg_atual != $lnk_impressos)
        {
        	echo "&nbsp;<a href=\"$arquivo&id=$lnk_impressos\">";
        }
        if ($pg_atual == $lnk_impressos)
        {
        	echo "&nbsp;<b>$lnk_impressos</b>&nbsp;";
        } 
        else 
        {
	        echo "&nbsp;$lnk_impressos";
	    }
	    ?>
	    </a>
	    </b>
	    </font>
		<?
	}
	?>
	</font>
	<font face="<?=$fontletra;?>" size="<?=$sizeletra;?>" color="<?=$corletra;?>">
	<?
	if ($reg_final < $totreg) 
	{
		?>
		&nbsp;
		<a href="<?=$arquivo;?>&id=<?=$pg_proxima;?>">
		<!-- <img src="buttom/direita.gif" border=0 height=20 width=40> -->
		>>
		</a>
		&nbsp;
		<a href="<?=$arquivo;?>&id=<?=$n_paginas;?>">
		<!-- <img src="buttom/ultimo.gif" border=0 height=20 width=40> -->
		>|
		</a>	
		<?
	}	
	?>
	</font>
	</td></tr>
	</table>
	</div>
	<?	
}// fim navipages


# infopages()
# Mostra informa�ao de numeros de p�gina e registros
function infopages()
{
	global $corbarra, 
		   $w_barra, 
		   $corletra, 
		   $sizeletra, 
		   $fontletra, 
		   $pg_atual, 
		   $n_paginas, 
		   $reg_final, 
		   $totreg,
		   $center,
		   $barborder;
		   		   
	if($center!=0)
	{
		echo "<center><div align='center'>";
	}	   
	else
	{
		echo "<div align='left'>";
	}				
	?>
	<table border="<?=$barborder;?>" cellspacing="0" width="<?=$w_barra;?>">
	<tr><td bgcolor="<?=$corbarra;?>" width="<?=$w_barra;?>">
	<font color="<?=$corletra;?>" size="<?=$sizeletra;?>" face="<?=$fontletra;?>">
	&nbsp;
	p�gina <?echo $pg_atual;?>/<?echo $n_paginas;?>
	&nbsp;-&nbsp;
	resultado <?echo $reg_final;?>/<?echo $totreg;?>
	</font>
	</td></tr></table>
	</div>
	<!-- final da barra contadora de paginas e resultados -->
	<?
} // fim infopages
