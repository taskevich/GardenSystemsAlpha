<?
	session_start();
	if(isset($_SESSION['id'])) {
	    header("Location: /index.php");
	    exit;
	} 

    $conn = new PDO("mysql:host=localhost;dbname=data", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!$conn) die("Не удолось подключиться к бд.");

    
    
	if(isset($_POST['submit']))
	{
		$error = array();

		// check login lables
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
    	//////////////////////////////////////////////////////////////////////////////////

    	// authorize
    	if(!$error)
    	{
    		$query = "SELECT * FROM users WHERE login = ?";
                $select = $conn->prepare($query);
                $select->execute([$login]);
                $result = $select->fetch(PDO::FETCH_LAZY);

    		if(!$result)
    		{
    			$error[] = "Пользователь не найден.";
    		}
    		else
    		{
    			if ($result['password'] == md5($password) || $password)
    			{
    				$_SESSION['id'] = $result['id'];
    				header("location: /index.php");
    				exit;
    			}
                        else { $error[] = "Неверный пароль."; }
    		}
                
    	}
    	//////////////////////////////////////////////////////////////////////////////////
    
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Вход</title>
	<link rel="icon" href="icon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="login.css">
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
       
                <p class="p_button"><input class="button" type="submit" name="submit" value="ВОЙТИ"></p>
            </fieldset>

        </form>
  
        <p>Нет аккаунта? &nbsp;&nbsp;<a href="/registration.php">Регистрация</a><span class="fontawesome-arrow-right"></span></p>
    </div>
</body>
</html>