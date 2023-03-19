<?php

require 'utils.php';

// Obt�m Fabricantes, para inserir no selectbox relacionado.
$SQL = 'SELECT id, fabricante
		FROM c_fabricantes
		ORDER BY fabricante ASC';
$resId = mysql_query($SQL);

// Array que ser� passado para a fun��o selectbox.
// O primeiro item, de chave 0 (primeiro �ndice do array), 
// indica para o usu�rio selecionar. Caso ele envie sem selecionar,
// ir� valor 0 e saberemos que n�o foi feita a sele��o.
$Fabricantes = array('Selecione');

// Passa os pares: ID do Fabricante => Nome do Fabricante
while($dados = mysql_fetch_array($resId))	
	$Fabricantes[$dados['id']] = $dados['fabricante'];

// Cria o selectbox com as fabricantes, passando os pares
// obtidos acima.
// O quarto par�metro � uma chamada a uma fun��o
// Javascript definida em validacao.js. A cada mudan�a
// nesse selectbox, ele chamar� essa fun��o.
$selectFabricantes = SelectBox($Fabricantes, 'fabricante', '', 'onChange="carregaModelos(this);"');

?>

<!-- INCLUI A CLASSE CPAINT - AJAX -->
<script type="text/javascript" src="lib/cpaint2.inc.compressed.js"></script>

<!-- Rotinas de valida��o do formul�rio -->
<script type="text/javascript" src="lib/validacao.js"></script>

<!-- Formul�rio -->
<form action="cadastro.php" method="post" onSubmit="return verificaForm(this);">
	<p>E-mail:<br />
		<input type="text" name="email" id="email" onblur="verificaEmail();"/> <span id="email_erro" style="color: red;"></span>
	</p>

	<p>Fabricante:<br />
		<?php echo $selectFabricantes; ?> <span id="fabricante_erro" style="color: red;"></span>
	</p>

	<p>Modelo:<br />
		<span id="modelos_local">Selecione um Fabricante</span> <span id="modelo_erro" style="color: red;"></span>
	</p>

	<p>Pre�o:<br />
		<input type="text" name="preco" id="preco" size="5" onblur="verificaPreco();"/> <span id="preco_erro" style="color: red;"></span>
	</p>

	<p><input type="submit" value="Enviar" /></p>
</form>