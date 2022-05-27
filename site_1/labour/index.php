<?
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location: /login.php");
        exit;
    } 

    $conn = new PDO("mysql:host=localhost;dbname=data", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!$conn) die("Не удалось подключиться к бд.");
    
    
     
    $id = $_SESSION['id'];
    $ik = 50;
    $uf = 50;
    $white = 50;
    $last= '';


    if(isset($_POST['datchicki']))
    { 
        switch ($_POST['datchicki']) {
            case 'temp_l':
                $data = $conn->query("SELECT temp_air, temp_earth FROM stats WHERE id = $id");
                foreach ($data as $k => $v){
                    $last = 'Temperature air: '.$v['temp_air'].' Temperature earth: '.$v['temp_earth']."\n"; 
                }
                break;
            case 'light_l':
                $data = $conn->query("SELECT light FROM stats WHERE id = $id");
                foreach ($data as $k => $v) {
                    $last = 'Light: '.$v['light']."\n"; 
                }
                break;
            case 'humidity_l':
                $data = $conn->query("SELECT humidity, humidity_air FROM stats WHERE id = $id");
                foreach ($data as $k => $v) {
                    $last = 'Humidity earth: '.$v['humidity']."\n".'Humidity air: '.$v['humidity_air']."\n"; 
                }
                break;
            case 'secret_l':
                header("Location: /secretpage.php");
                exit;
                break;
            default:
                break;
        }
    }



    

    if(isset($_POST['culture']))
    {
        switch($_POST['culture'])
        {
            case 'pickle':
                break;
            case 'carrot':
                break;
            case 'cabbage':
                break;
            case 'berries':
                break;
            default:
                break;
        }
    }



    if(isset($_POST['logout']))
    {
        session_destroy();
        header("Location: /login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>БАДЯГА</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="block">
<!--Загаловок-->
<div class="head">
    <img class="logo" src="logo_gap.jpg" alt="#">
<h1>БАДЯГА</h1>
<form method="POST">
    <div class="exit">
        <button name="logout" type="submit" class="btn" value="Выйти">Выйти</button>
    </div>
</form>
</div>
<div class="container">
<!--Ползунки-->
<div class="button">
<form  method="POST">
<form id="1" method="POST">
    
    <div class="text">
    <p>ИК</p>
    <p><? echo isset($_POST['IK']) ? $_POST['IK'] : $ik; $ik = $_POST['IK']; ?></p>
    </div>
    <div class="pol">
        <input type="range" min="0" max="100" value="<? $ik; ?>" id="ik" name="IK">
    <input class="btn"class="instal" type=submit value=Установить />
</div>
</form>
<form id="2" method="POST">
    <div class="text">
    <p>УФ</p>
    <p><? echo isset($_POST['UF']) ? $_POST['UF'] : $uf; $uf = $_POST['UF']; ?></p>
</div>
    <div class="pol">
        <input type="range" min="0" max="100" value="<? $uf; ?>" id="ik" name="UF">
    <input class="btn" class="instal" type=submit value=Установить />
    </div>
</form>
<form id="3" method="POST">
    <div class="text">
    <p>БЕЛЫЙ</p>
    <p><? echo isset($_POST['WHITE']) ? $_POST['WHITE'] : $white; $white = $_POST['WHITE']; ?></p>
</div>
    <div class="pol">
        <input type="range" min="0" max="100" value="<? $white; ?>" id="ik" name="WHITE">
    <input class="btn" class="instal" type=submit value=Установить />
</div>
</form>
</form>
</div>
<!--Датчики-->
<div class="itog_block">
<div class="itog">
    <form action="#">
        <textarea class="result" contenteditable="false" name="result" id="res" readonly="readonly" cols="30" rows="10"><? echo $last ?></textarea>
    </form>
</div>
<form class="button_form" action="index.php" method="POST">
    <select name="datchicki" class="spisok" method="POST">
        <option value="temp_l"><div class="divka" id="1"><button name="stats" type="submit" class="btn" value="temperature"> Температура </button></div>
        <option value="light_l"><div class="divka" id="2"><button name="stats" type="submit" class="btn" value="light"> Освещение </button></div>
        <option value="humidity_l"><div class="divka" id="3"><button name="stats" type="submit" class="btn" value="humidity"> Влажность </button></div>
        <option value="secret_l"><div class="divka" id="4"><button name="stats" type="submit" class="btn" value="light"> Секрет </button></div>
    </select>
    <select method="POST" class="spisok" name="culture">
        <option value="pickle">Огурцы
        <option value="berries">Ягоды
        <option value="radish">Редис
        <option value="cabbage">Капуста
        <option value="potato">Картофель
        <option value="carrot">Морковь
    </select>
    <input type="submit" name="data" class="btn" value="Получить">

 <div class="radio">
<div class="form_radio_btn">
    <input id="radio-1" type="radio" name="radio" value="1" checked>
    <label for="radio-1">Клапан</label>
</div>
 
<div class="form_radio_btn">
    <input id="radio-2" type="radio" name="radio" value="2">
    <label for="radio-2">Насос</label>
</div>
</div>
</form>


</div>
</div>
</body>
</html>				