<!DOCTYPE html>
<html lang="pt-br">
	<body>
		
		<h1>
		<a href="http://localhost/mapos/xml/"><button style="background: 
		#069cc2; border-radius: 6px; padding: 15px; cursor: pointer; 
		color: #fff; border: none; font-size: 16px;">Enviar outro XML</button></a>

<a href="http://localhost/mapos/index.php/produtos/"><button style="background: 
		#00719c; border-radius: 6px; padding: 15px; cursor: pointer; 
		color: #fff; border: none; font-size: 16px;">Voltar ao Sistema</button></a>
		<br><br>
</html>

<?php

	
	include_once("database.php");
	
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);

	if(!empty($_FILES['arquivo']['tmp_name'])){
		$arquivo = new DomDocument();
		$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);
		
		$linhas = $arquivo->getElementsByTagName("prod");
		//var_dump($linhas);
		
		$primeira_linha = true;
		
		foreach($linhas as $linha) {
			if ($primeira_linha == false);{	
			
		
				$idProdutos = $linha->getElementsByTagName("")->item(0)->nodeValue;
				echo "Id: $idProdutos <br>";
				
				$codDeBarra = $linha->getElementsByTagName("cEAN")->item(0)->nodeValue;
				echo "Código de Barras: $codDeBarra <br>";
				
				$descricao = $linha->getElementsByTagName("xProd")->item(0)->nodeValue;
				echo "Nome: $descricao <br>";
				
				$unidade = $linha->getElementsByTagName("uCom")->item(0)->nodeValue;
				echo "Tipo: $unidade <br>";
				
				$precoCompra = $linha->getElementsByTagName("vProd")->item(0)->nodeValue;
				echo "Valor da Compra: $precoCompra <br>";
				
				//porcentgem de sobre o preço de compra
				$precoVenda = $precoCompra * 100 / 80;
				echo "Valor da Venda: $precoVenda <br>";
				
				$estoque = $linha->getElementsByTagName("qCom")->item(0)->nodeValue;
				echo "Quantidade: $estoque <br>";

				echo "<hr>";
				
				//Inserir o usuario no BD
				$resultado_xml = "INSERT INTO produtos (idProdutos, codDeBarra, descricao, unidade, precoCompra, precoVenda, estoque, estoqueMinimo, saida, entrada) VALUES 
				('$idProdutos', '$codDeBarra', '$descricao', '$unidade', '$precoCompra', '$precoVenda', '$estoque', '1', '', '')";
				 $resultado_xml = mysqli_query($conn, $resultado_xml);
				 

			}
			$primeira_linha = false;
		}
	}
?>