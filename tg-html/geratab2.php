 <?php
	session_start();
	include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Planilha de atuadores</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'atuadores.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td><b>Data e Hora</b></td>';
		$html .= '<td><b>Ventilação</b></td>';
		$html .= '<td><b>Iluminação</b></td>';
		$html .= '<td><b>Irrigação</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$result_msg_atuadores = "SELECT * FROM atuadores ORDER BY time DESC LIMIT 30;";
		$resultado_msg_atuadores = mysqli_query($conn , $result_msg_atuadores);
		
		while($row_msg_atuadores = mysqli_fetch_assoc($resultado_msg_atuadores)){
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_atuadores["time"].'</td>';
			$html .= '<td>'.$row_msg_atuadores["vent"].'</td>';
			$html .= '<td>'.$row_msg_atuadores["ilum"].'</td>';
			$html .= '<td>'.$row_msg_atuadores["irri"].'</td>';
			$html .= '</tr>';
			;
		}
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>
</html>
