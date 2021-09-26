<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="ru">
    <meta name="description" content="This is 5 lab">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Test</title>
</head>
<body>
    <main>
        <form method="post">		
			<main>
				<select name="user">
					<option <?php if($_POST['user'] == 1) echo "selected " ?> value="1">По Id пользователя</option>
					<option <?php if($_POST['user'] == 2) echo "selected " ?> value="2">По логину пользователя</option>
					<option <?php if($_POST['user'] == 3) echo "selected " ?> value="3">По паролю пользователя</option>
					<option <?php if($_POST['user'] == 4) echo "selected " ?> value="4">По IP адресу пользователя</option>
				</select>
				<select name="ipAddress">
					<option <?php if($_POST['ipAddress'] == 1) echo "selected " ?> value="1">По Id пользователя</option>
					<option <?php if($_POST['ipAddress'] == 2) echo "selected " ?> value="2">По городу пользователя</option>
					<option <?php if($_POST['ipAddress'] == 3) echo "selected " ?> value="3">По дому пользователя</option>
					<option <?php if($_POST['ipAddress'] == 4) echo "selected " ?> value="4">По квартире пользователя</option>
				</select>
				<button type="submit">Получить данные</button>								
			</main>				
			<?php
				error_reporting(0);								
				$place = "localhost";
				$user = "root";
				$password = "28092001";
				$databaseName = "Test";
				$database = mysqli_connect($place, $user, $password, $databaseName);
				$count = rand(2, 5);					
				$logins = array("Varianel", "Varian", "Isonjayd", "Monand",
				"Perreth", "Wennyani", "Oyalassi", "Sirileat", "Urayan", "Kalaish");
				$passwords = array("71847817", "73888492", "27830606", "24969543", 
				"74246152", "55217235", "37235156", "91424090", "05092467", "11816386");
				$ipAddresses = array("140.76.237.122", "137.132.2.198", "8.81.182.0", "142.34.240.7",
				"168.239.158.249", "233.36.90.197", "223.201.231.133", "102.8.73.165", "16.7.85.64", "244.59.63.209");
				mysqli_query($database, "ALTER TABLE user AUTO_INCREMENT = 4");				
				function output1($request) {					
					while($table = mysqli_fetch_array($request)) {
						echo "<div>Id пользователя: ".$table['id'].";</div>";
						echo "<div>Логин пользователя: ".$table['login'].";</div>";
						echo "<div>Пароль пользователя: ".$table['password'].";</div>";
						echo "<div>IP адресс пользователя: ".$table['ipAddress'].";</div>";											
					}									
				}	
				function output2($request) {					
					while($table = mysqli_fetch_array($request)) {		
						echo "<div>Id пользователя: ".$table['id'].";</div>";
						echo "<div>Город пользователя: ".$table['city'].";</div>";
						echo "<div>Дом пользователя: ".$table['house'].";</div>";
						echo "<div>Квартира пользователя: ".$table['flat'].";</div>";										
					}									
				}
				function task($count, $logins, $passwords, $ipAddresses) {
					global $database;					
					for($i = 0; $i < $count; $i++) {
						$request = "INSERT INTO user (id, login, password, ipAddress) VALUES (NULL".","."'".$logins[rand(0, 9)]."'".","."'".$passwords[rand(0, 9)]."'".","."'".$ipAddresses[rand(0, 9)]."'".")";
						$result = mysqli_query($database, $request);
						if($result == false) 
							echo "Ошибка при добавлении данных.";						
					}
				}
				if($database != false) {
					$index1 = $_POST['user'];							
					$index2 = $_POST['ipAddress'];
					mysqli_set_charset($database, "utf8");
					$request1 = "SELECT * FROM user ORDER BY user";
					$request2 = "SELECT * FROM ipaddress ORDER BY ipaddress";
					switch($index1) {
						case 1: 
							$request1 .= ".id ASC";
							break;
						case 2:
							$request1 .= ".login ASC";
							break;
						case 3: 
							$request1 .= ".password ASC";
							break;
						case 4:
							$request1 .= ".ipAddress ASC";				
					}
					switch($index2) {
						case 1: 
							$request2 .= ".id ASC";
							break;
						case 2:
							$request2 .= ".city ASC";
							break;
						case 3: 
							$request2 .= ".house ASC";
							break;
						case 4:
							$request2 .= ".flat ASC";				
					}					
					//task($count, $logins, $passwords, $ipAddresses);					
					output1(mysqli_query($database, $request1));					
					echo "<br />";
					output2(mysqli_query($database, $request2));					
				}
				else 
					echo "Возникла ошибка.";
			?>
        </form>		
    </main>
</body>
</html>		