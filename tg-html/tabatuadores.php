
<?php
// definições de host, database, usuário e senha
$host = "localhost";
$user = "root";
$pass = "34931123";
// conecta ao banco de dados
$con = mysqli_connect($host, $user, $pass) or trigger_error(mysqli_error(),E_USER_ERROR); 
// seleciona a base de dados em que vamos trabalhar
mysqli_select_db($con,"rasprush" );
// cria a instrução SQL que vai selecionar os dados
$query = sprintf("SELECT * FROM teste0");
// executa a query
$dados = mysqli_query($con, "select * from atuadores ORDER BY time DESC LIMIT 1;");
// transforma os dados em um array
$linha = mysqli_fetch_assoc($dados);
// calcula quantos dados retornaram
$total = mysqli_num_rows($dados);
?>

<! DOCTYPE html> 
<html>
    <head>
    <title>Tabela de Atuadores</title>
<meta charset="UTF-8">












		


</head>
<body>
<?php
    // se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
	echo "<table id = 'leitura'>";
	echo "<tr><th>Data e Hora</th>"
	."<th>Ventilação</th>"
	."<th>Iluminação</th>"
	."<th>Irrigação</th>"
	."</tr>";
        // inicia o loop que vai mostrar todos os dados
        do {
?>
            <tr><td><p><?=$linha['time']?></td><td><?=$linha['vent']?></p></td><td><?=$linha['ilum']?></p></td><td><?=$linha['irri']?></p></td></tr>
<?php
        // finaliza o loop que vai mostrar os dados
        }while($linha = mysqli_fetch_assoc($dados));
    // fim do if 
    }
    
?>
	</table>

	












</body>
</html>


<?php
// tira o resultado da busca da memória
mysqli_free_result($dados);
?>
