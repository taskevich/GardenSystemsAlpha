<?
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location: /login.php");
        exit;
    } 

    require_once('config.php');

    $data = $_POST;
    
#    $ik = 50;
#    $uf = 50;
#    $white = 50;
    
    if(isset($data['set_sensors']))
    {
        
        $ik = $data['IK'];
        $uf = $data['UF'];
        $white = $data['WHITE'];

        
        $url1 = "https://api.thingspeak.com/update?api_key=FBRMSXINO4PQ5GJD&field1=$ik";
        $contents1 = file_get_contents($url1);
        echo $contents1;
        
        $url2 = "https://api.thingspeak.com/update?api_key=FBRMSXINO4PQ5GJD&field2=$uf";
        $contents2 = file_get_contents($url2);
        echo $contents2;
        
        $url3 = "https://api.thingspeak.com/update?api_key=FBRMSXINO4PQ5GJD&field3=$white";
        $contents3 = file_get_contents($url3);
        echo $contents3;
    }

    if(isset($data['secret']))
    {
        header("Location: /secretpage.php");
    }

    if(isset($data['exit']))
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
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no" >
    <title>БАДЯГА</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="scripts/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

    <body>
        <div id="line_top_x"></div>
        <div class="head">
            <img class="logo" src="ass/logo_gap.jpg" alt="#">
            <h1 style="margin: auto 0;">БАДЯГА</h1>
            <form method="POST">
                <div class="exit">
                    <button name="exit" type="submit" class="btn" value="Выйти">Выйти</button>
                </div>
            </form>
        </div>

        <div class="main">
<div class="badur">
            <!----------------------- ПОЛЗУНКИ ----------------------->
            <div class="trackbars">
                <form action="index.php" method="POST">
                    <form action="index.php" id="1">
                        <div class="text">
                            <p>ИК: <output id="sld_1">50</output></p>
                        </div>
                        <input type="range" min="0" max="100" value="50" id="ik" name="IK" oninput="onUpdate(value)">

                        <div class="text">
                            <p>УФ: <output id="sld_2">50</output></p>
                        </div>
                        <input type="range" min="0" max="100" value="50" id="ik" name="UF" oninput="onUpdate1(value)">

                        <div class="text">
                            <p>БЕЛЫЙ: <output id="sld_3">50</output></p>
                        </div>

                        <input type="range" min="0" max="100" value="50" id="ik" name="WHITE" oninput="onUpdate2(value)">
                       
                    </form>
                </form>
<div class="typelist">
                <button class="btn" id="setter" name="set_sensors">Установить</button>
 <select onchange="lists(event)" id="drop_list" class="btn">
                            <option value="pickle">Огурцы</option>
                            <option value="barries">Ягоды</option>
                            <option value="appels">Яблоки</option>
                        </select>
</div>
                <script>

                    $(document).ready(function ()
                    {
                        $('#setter').bind('click', function(event)
                        {
                            event.preventDefault();
                            
                        });
                    });
                    
                </script>
                <!----------------------- ФУНКЦИИ ----------------------->
                <form action="index.php" method="POST" style="width: 50%;">
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
                <!----------------------- ФУНКЦИИ ЭНД ----------------------->
            </div>

            <!-- drop_list --->


            <!----------------------- ПОЛЗУНКИ ЭНД ----------------------->

            <!----------------------- КНОПКИ ----------------------->
                <form action="index.php" method="POST" class="sensors">
                    <button data-target="#btn_1" name="temperature" value="" class="btn">Температура: 0</button>
                    <button data-target="#btn_2" class="btn" name="light" value="">Освещение: 0</button>
                    <button data-target="#btn_3" class="btn" name="humidity" value="">Влажность: 0</button>
                    <button data-target="#btn_4" class="btn" name="secret" value="">Секрет</button>
                    <script>
                        rnd_numbers();
                    </script>
            </form>


            <!----------------------- КНОПКИ ЭНД ----------------------->
</div>
<div class="grafic">
<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1749556/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
    <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1749556/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
    <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1749556/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
</div>
        </div>  


    </body>
</html>						