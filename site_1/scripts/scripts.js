let max_temp = 40;
let min_temp = 0;
let max_humidity = 100;
let min_humidity = 40;

function ik_sensor(number)
{
    let ids = document.querySelector("#sld_1");
    let url = "https://api.thingspeak.com/update?api_key=7NYG2C5JMUHVV7JC&field1=" + (number).toString();

    $.post(url, function () {
        console.log('success');
    });
}

function uf_sensor(number)
{
    let ids = document.querySelector("#sld_2");
    let url = "https://api.thingspeak.com/update?api_key=7NYG2C5JMUHVV7JC&field2=" + (number).toString();

    $.post(url, function () {
        console.log('success');
    });
}

function white_sensor(number)
{
    let ids = document.querySelector("#sld_3");
    let url = "https://api.thingspeak.com/update?api_key=7NYG2C5JMUHVV7JC&field3=" + (number).toString();

    $.post(url, function () {
        console.log('success');
    });
}

function rnd_numbers() 
{
    let number = 0;
    const button = document.body.querySelector('[data-target="#btn_1"]');
    const button_2 = document.body.querySelector('[data-target="#btn_2"]');
    const button_3 = document.body.querySelector('[data-target="#btn_3"]');
    function changeButtonText() 
    {
        number = Math.floor(Math.random() * (max_temp - min_temp) + min_temp);
        ik_sensor(number);
        button.innerText = "Температура: " + number.toString();
        button.setAttribute("value", number);
        
        number = Math.floor(Math.random() * 100);
        uf_sensor(number);
        button_2.innerText = "Освещение: " + number.toString();
        button_2.setAttribute("value", number);

        number = Math.floor(Math.random() * (max_humidity - min_humidity) + min_humidity);
        white_sensor(number);
        button_3.innerText = "Влажность: " + number.toString();
        button_3.setAttribute("value", number);
    }
    let timerId = setInterval(() => changeButtonText(), 2000);
}

function onUpdate(value)
{
    var output = document.querySelector("#sld_1");
    output.value = value;
    output.style.left = value - 20 + 'px';
}

function onUpdate1(value)
{
    var output = document.querySelector("#sld_2");
    output.value = value;
    output.style.left = value - 20 + 'px';
}

function onUpdate2(value)
{
    var output = document.querySelector("#sld_3");
    output.value = value;
    output.style.left = value - 20 + 'px';
}

function lists (event)
{
    let drop = document.getElementById('drop_list');
    drop.onchange = event => 
    {
        switch (event.target.value) {
            case 'pickle':
                max_humidity = 90;
                min_humidity = 80;
                max_temp = 25;
                min_temp = 18;
                break;
            case 'barries':
                max_humidity = 90;
                min_humidity = 70;
                max_temp = 35;
                min_temp = 25;
                break;
            case 'apples':
                max_humidity = 90;
                min_humidity = 60;
                max_temp = 30;
                min_temp = 0;
                break;
            default:
                break;
        }
    }
}

