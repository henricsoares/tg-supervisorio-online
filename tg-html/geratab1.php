 <?php
	session_start();
	include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Planilha de sensores</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td><b>Data e Hora</b></td>';
		$html .= '<td><b>Temperatura (ºC)</b></td>';
		$html .= '<td><b>Luminosidade (%)</b></td>';
		$html .= '<td><b>Umidade (%)</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$result_msg_sensores = "SELECT * FROM sensores";
		$resultado_msg_sensores = mysqli_query($conn , $result_msg_sensores);
		
		while($row_msg_sensores = mysqli_fetch_assoc($resultado_msg_sensores)){
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_sensores["time"].'</td>';
			$html .= '<td>'.$row_msg_sensores["temp"].'</td>';
			$html .= '<td>'.$row_msg_sensores["lumi"].'</td>';
			$html .= '<td>'.$row_msg_sensores["umi"].'</td>';
			$html .= '</tr>';
			;
		}
				
		header("Content-Type: application/msexcel");
        header ("Content-Disposition: attachment; filename=sensores.xls" );
		
		header ("Cache-Control: max-age=0");
		
		
		echo $html;
		exit; ?>
	</body>
</html>
