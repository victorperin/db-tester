<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body>

		<?php

			include 'config.php';
			
			set_time_limit(0);
			$db = mysqli_connect($db_server,$db_user,$db_pass,$db_database);
			
			
			$string_step = "select instalation_step from db_tester";
			$query_step = mysqli_query($db,$string_step);	
			while($inst_step = mysqli_fetch_array($query_step)){
				$instalation_step = $row['instalation_step'];
			}
			
			if($instalation_step <> 5 ) {
				include 'install.php';
				exit;
			}
			
			
			
			
			
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
