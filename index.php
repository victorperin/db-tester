<!DOCTYPE html>
<html lang="br">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body>

		<?php

			$db_server = "127.0.0.1";
			$db_user = "root";
			$db_pass = "";
			$db_database = "test";
			$number_of_queries_by_feature = 500;




			set_time_limit(0);
			$db = mysqli_connect($db_server,$db_user,$db_pass,$db_database);
			
			echo 'PHP Time: '.date("Y-m-d H:i:s");



			for ($x=0; $x<=$number_of_queries_by_feature; $x++) {
				$select_simples = "select  Name from city";
				$start_time=microtime(true);
				mysqli_query($db,$select_simples);	
				$stop_time=microtime(true);

				$select_simples_store = "insert into queries (tipo,tempo) VALUES ('select simples','".number_format($stop_time-$start_time,5)."')";
				mysqli_query($db,$select_simples_store);	


				$select_where = "select  name from city where Population like '%".mt_rand(0,500)."%' ";
				echo $select_where."<br/>";
				$start_time=microtime(true);
				mysqli_query($db,$select_where);	
				$stop_time=microtime(true);

				$select_where_store = "insert into queries (tipo,tempo) VALUES ('select where','".number_format($stop_time-$start_time,5)."')";
				mysqli_query($db,$select_where_store);	

			}
			unset($x);

		?>
	</body>
</html>