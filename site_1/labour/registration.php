<?
	session_start();
	if(isset($_SESSION['id'])) {
	    header("Location: /admin.php");
	    exit;
	} 
	$conn = new PDO("mysql:host=localhost;dbname=data", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!$conn) die("Не удолось подключиться к бд.");

	if (isset($_POST['submit']))
	{
		$error = array();

		// check lables
		if(strlen($_POST['password']) < 4)
		{
			$error[] = "Размер поля <b>Пароль</b> должен быть больше 4";
		} else
		{
			$password = @htmlspecialchars($_POST['password']);
        	$password = md5($password);
		}

		if(strlen($_POST['login']) < 3)
		{
			$error[] = "Размер поля <b>Логин</b> должен быть больше 4";
		}
		else
		{
			$login = $_POST['login'];
		}

		if(!$error) 
		{ 

	        if(strlen($_POST['login']) > 25) {
	            $error[] = "Размер поля <b>Логин</b> должен быть меньше 25 символов";
	        } 

	        if(strlen($_POST['password']) > 25) 
	        {
	            $error[] = "Размер поля <b>Пароль</b> должен быть меньше 25 символов";
	        }
    	}

		if(!$error) {
			$sql = "SELECT count(id) as count FROM users WHERE login = ?";
			$query = $conn->prepare($sql);
			$query->execute([$login]);
			$count_users = $query->fetch();
			if(!((int) $count_users['count'] === 0))
				$error[] = "Аккаунт уже существует!";
		}

    	if (!$error)
    	{
            
            $temp_air = random_int(0, 100);
            $temp_earth = random_int(0, 100);
            $light = random_int(0, 100);
            $humidity = random_int(0, 100);
            
            
            
    		$request = "INSERT INTO users (login, password) VALUES (?, ?)";
    		$insert = $conn->prepare($request);
    		$result = $insert->execute([$login, md5($password)]);

            $id = $_SESSION['id'];
            $in = "INSERT INTO stats (temp_air, temp_earth, light, humidity) VALUES ($temp_air, $temp_earth, $light, $humidity)";
            $conn->exec($in);
            
    		if ($result)
    		{
    			$_SESSION['id'] = $conn->lastInsertId();
    			header("location: /index.php");
    			exit();
    	    }
    	}
    	else
    	{
    		$error[] = "Ошибка регистрации. Проверьте пожалуйста данные!";
    	}
    }





?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Регистрация</title>
	<link rel="icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="header">
        <p class="header_p">Бадяга</p>
    </div>

    <div id="login">
        
       
        <form method="POST">
            <fieldset class="clearfix">
                  <?php 
                    if(isset($error)){?>
                <p class="errors">
                  <?php
                    foreach ($error as $val) {
                        echo $val."<br>";
                    }
                ?>
                </p>
                <?php  } ?>
                <div class="p_form"><p class="login">Логин</p></div>
                <p><span class="fontawesome-user"></span><input class="logincss" type="text" name="login" value="<?=@$login?>" placeholder="Логин" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
                <div class="p_form"><p class="password">Пароль</p></div>
                <p><span class="fontawesome-lock"></span><input class="passwordcss" type="password" name="password" placeholder="Пароль" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
       
                <p class="p_button"><input type="submit" class="button" name="submit" value="Зарегестрироваться"></p>
            </fieldset>

        </form>
        <!---<p>Нет аккаунта? &nbsp;&nbsp;<a href="/register.php">Регистрация</a><span class="fontawesome-arrow-right"></span></p>--->
    </div>
</body>
</html>