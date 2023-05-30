<?php

$username = "root";
$password = "Equipo3_Password";
$host = "localhost";
$db = "estacion";
$conn = mysqli_connect($host,$username,$password,$db);

/*
$db_username = "root";
$db_password = "";
$host = "localhost";
$db_name = "estacion";
$conn = mysqli_connect($host, $db_username, $db_password, $db_name);
*/

if (!$conn) {
    die("Cannot connect!");
} else {
    $resultadoTemp = mysqli_query($conn, "SELECT temperatura FROM DatosClima ORDER BY created_at DESC LIMIT 1;");
    $resultadoHum = mysqli_query($conn, "SELECT humedad FROM DatosClima ORDER BY created_at DESC LIMIT 1;");
    $resultadoLux = mysqli_query($conn, "SELECT luminosidad FROM DatosClima ORDER BY created_at DESC LIMIT 1;");
    $resultadoViento = mysqli_query($conn, "SELECT vel_viento FROM DatosClima ORDER BY created_at DESC LIMIT 1;");
    $resultadoPresion = mysqli_query($conn, "SELECT presion_atm FROM DatosClima ORDER BY created_at DESC LIMIT 1;");
    $resultadoFecha = mysqli_query($conn, "SELECT created_at FROM DatosClima ORDER BY created_at DESC LIMIT 1;");

    if($resultadoFecha ->num_rows > 0){
        $fecha = array();

        while ($row = $resultadoFecha->fetch_array()) {
            $fecha[] = $row['created_at'];
        }
    }
    if ($resultadoTemp->num_rows > 0) {
        $temperatura = array();

        while ($row = $resultadoTemp->fetch_array()) {
            $temperatura[] = $row['temperatura'];
        }
    }
    if ($resultadoHum->num_rows > 0) {
        $tiempo = array();

        while ($row = $resultadoHum->fetch_array()) {
            $tiempo[] = $row['humedad'];
        }
    }
    if ($resultadoLux->num_rows > 0) {
        $lux = array();

        while ($row = $resultadoLux->fetch_array()) {
            $lux[] = $row['luminosidad'];
        }
    }
    if ($resultadoViento->num_rows > 0) {
        $viento = array();

        while ($row = $resultadoViento->fetch_array()) {
            $viento[] = $row['vel_viento'];
        }
    }
    if ($resultadoPresion->num_rows > 0) {
        $presion = array();

        while ($row = $resultadoPresion->fetch_array()) {
            $presion[] = $row['presion_atm'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="10" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Script CSS Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Script Bundle Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--Script Popper Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-------------------->
    <title>Estación Meteorológica</title>
    <!--Style-->
    <style>
        nav {
            background-color: #C4E89C;
        }

        .navbar{
            justify-content: center;
        }

        .navbar-brand {
            text-transform: uppercase;
            font-size: 25px;
        }

        .navText{
            font-weight: bold;
        }

        h1 {
            text-align: center;
            font-family: "Roboto", sans-serif;
            color: black;
        }

        h4{
            display: flex;
            align-items: center;
            justify-content: center;
        }



        /*Temperatura*/
        .gauge {
            width: 100%;
            /*max-width: 250px;*/
            font-family: "Roboto", sans-serif;
            font-size: 25px;
            color: #004033;
        }

        .gauge__body {
            width: 100%;
            height: 0;
            padding-bottom: 50%;
            background: #b4c0be;
            position: relative;
            border-top-left-radius: 100% 200%;
            border-top-right-radius: 100% 200%;
            overflow: hidden;
        }

        .gauge__fill {
            position: absolute;
            top: 100%;
            left: 0;
            width: inherit;
            height: 100%;
            background: #0000ff;
            /*color barra*/
            transform-origin: center top;
            transform: rotate(0.25turn);
            transition: transform 0.2s ease-out;
        }

        .gauge__cover {
            width: 75%;
            height: 150%;
            background: #ffffff;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 55%;
            box-sizing: border-box;
        }

        .gauge__cover_F {
            width: 75%;
            height: 150%;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 32.5%;
            box-sizing: border-box;
        }

        .gauge__cover_K {
            width: 75%;
            height: 150%;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-52.5%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 10%;
            box-sizing: border-box;
        }

        /*----------------*/

        /*Humedad*/
        .gauge__H {
            width: 100%;
            /*max-width: 250px;*/
            font-family: "Roboto", sans-serif;
            font-size: 25px;
            color: #004033;
        }

        .gauge__fill__H {
            position: absolute;
            top: 100%;
            left: 0;
            width: inherit;
            height: 100%;
            background: #FFFF00;
            transform-origin: center top;
            transform: rotate(0.25turn);
            transition: transform 0.2s ease-out;
        }

        .gauge__body__H {
            width: 100%;
            height: 0;
            padding-bottom: 50%;
            background: #b4c0be;
            position: relative;
            border-top-left-radius: 100% 200%;
            border-top-right-radius: 100% 200%;
            overflow: hidden;
        }

        .gauge__cover__H {
            width: 75%;
            height: 150%;
            background: #ffffff;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 25%;
            box-sizing: border-box;
        }

        /*----------------*/

        /*Luminosidad*/
        .gauge__L {
            width: 100%;
            /*max-width: 250px;*/
            font-family: "Roboto", sans-serif;
            font-size: 25px;
            color: #004033;
        }

        .gauge__fill__L {
            position: absolute;
            top: 100%;
            left: 0;
            width: inherit;
            height: 100%;
            background: #ff8000;
            transform-origin: center top;
            transform: rotate(0.25turn);
            transition: transform 0.2s ease-out;
        }

        .gauge__body__L {
            width: 100%;
            height: 0;
            padding-bottom: 50%;
            background: #b4c0be;
            position: relative;
            border-top-left-radius: 100% 200%;
            border-top-right-radius: 100% 200%;
            overflow: hidden;
        }

        .gauge__cover__L {
            width: 75%;
            height: 150%;
            background: #ffffff;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 25%;
            box-sizing: border-box;
        }

        /*----------------*/

        /*Viento*/
        .gauge__V {
            width: 100%;
            /*max-width: 250px;*/
            font-family: "Roboto", sans-serif;
            font-size: 25px;
            color: #004033;
        }

        .gauge__fill__V {
            position: absolute;
            top: 100%;
            left: 0;
            width: inherit;
            height: 100%;
            background: #ff0000;
            transform-origin: center top;
            transform: rotate(0.25turn);
            transition: transform 0.2s ease-out;
        }

        .gauge__body__V {
            width: 100%;
            height: 0;
            padding-bottom: 50%;
            background: #b4c0be;
            position: relative;
            border-top-left-radius: 100% 200%;
            border-top-right-radius: 100% 200%;
            overflow: hidden;
        }

        .gauge__cover__V {
            width: 75%;
            height: 150%;
            background: #ffffff;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 55%;
            box-sizing: border-box;
        }

        .gauge__cover_V_M {
            width: 75%;
            height: 150%;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 32.5%;
            box-sizing: border-box;
        }

        .gauge__cover_V_Milla {
            width: 75%;
            height: 150%;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-52.5%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 10%;
            box-sizing: border-box;
        }

        /*----------------*/

        /*Presión*/
        .gauge__P {
            width: 100%;
            /*max-width: 250px;*/
            font-family: "Roboto", sans-serif;
            font-size: 25px;
            color: #004033;
        }

        .gauge__fill__P {
            position: absolute;
            top: 100%;
            left: 0;
            width: inherit;
            height: 100%;
            background: #7BEE00;
            transform-origin: center top;
            transform: rotate(0.25turn);
            transition: transform 0.2s ease-out;
        }

        .gauge__body__P {
            width: 100%;
            height: 0;
            padding-bottom: 50%;
            background: #b4c0be;
            position: relative;
            border-top-left-radius: 100% 200%;
            border-top-right-radius: 100% 200%;
            overflow: hidden;
        }

        .gauge__cover__P {
            width: 75%;
            height: 150%;
            background: #ffffff;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);

            /* Text */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 25%;
            box-sizing: border-box;
        }

        /*----------------*/
    </style>
    <!--Style end-->
</head>

<body>
    <nav class="nav navbar mb-4">
        <h1 class="navbar-brand navText">Estación Meteorológica</h1>
    </nav>
    <div class="container">
        <div>
            <h4 class="mb-5">Último dato recolectado el
                <?php

                date_default_timezone_set("America/Mexico_City");
                setlocale(LC_TIME, 'es_ES.UTF-8', 'esp');
                $date = strtotime(implode(" ", $fecha));
                echo strftime('%a %e de %B de %Y', $date);
                echo " a las ";
                echo date("g:i a", $date);

                //echo strftime(date("j F Y, g:i a", $date));
                ?>
            </h4>
        </div>

        <div class="row">
            <div class="col">
                <div class="gauge">
                    <h1>Temperatura</h1>
                    <div class="gauge__body">
                        <div class="gauge__fill"></div>
                        <div class="gauge__cover"></div>
                        <div class="gauge__cover_F"></div>
                        <div class="gauge__cover_K"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="gauge__H">
                    <h1>Humedad</h1>
                    <div class="gauge__body__H">
                        <div class="gauge__fill__H"></div>
                        <div class="gauge__cover__H"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="gauge__L">
                    <h1>Luminosidad</h1>
                    <div class="gauge__body__L">
                        <div class="gauge__fill__L"></div>
                        <div class="gauge__cover__L"></div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col">
                <div class="gauge__V">
                    <h1>Velocidad Viento</h1>
                    <div class="gauge__body__V">
                        <div class="gauge__fill__V"></div>
                        <div class="gauge__cover__V"></div>
                        <div class="gauge__cover_V_M"></div>
                        <div class="gauge__cover_V_Milla"></div>
                    </div>
                </div>
            </div>
            <!--COL DIVISOR-->
            <div class="col"></div>
            <!--COL DIVISOR-->
            <div class="col">
                <div class="gauge__P">
                    <h1>Presión Atmosférica</h1>
                    <div class="gauge__body__P">
                        <div class="gauge__fill__P"></div>
                        <div class="gauge__cover__P"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Script Temperatura-->
    <script>
        const gaugeElement = document.querySelector(".gauge");

        function setGaugeValue(gauge, value) {
            /*if (value < 0 || value > 1) {
                return;
            }*/

            a = Math.round((value + Number.EPSILON) * 100);
            b = Math.round((value + Number.EPSILON) * 100) * (9 / 5) + 32;
            c = Math.round((value + Number.EPSILON) * 100) + 273.15;
            gauge.querySelector(".gauge__fill").style.transform = `rotate(${value / 2}turn)`;
            gauge.querySelector(".gauge__cover").textContent = `${a.toFixed(2)}°C`;
            gauge.querySelector(".gauge__cover_F").textContent = `${b.toFixed(2)}°F`;
            gauge.querySelector(".gauge__cover_K").textContent = `${c.toFixed(2)}°K`;

        }
        setGaugeValue(gaugeElement, <?php echo json_encode($temperatura); ?> / 100);
    </script>

    <!--Script Humedad-->
    <script>
        const gaugeElementHumidity = document.querySelector(".gauge__H");

        function setGaugeValue_H(gauge_H, value_H) {
            a = Math.round((value_H + Number.EPSILON) * 100);
            gauge_H.querySelector(".gauge__fill__H").style.transform = `rotate(${value_H / 2}turn)`;
            gauge_H.querySelector(".gauge__cover__H").textContent = `${a.toFixed(2)}%`;
        }
        setGaugeValue_H(gaugeElementHumidity, <?php echo json_encode($tiempo); ?> / 100);
    </script>

    <!--Script Luminosidad-->
    <script>
        const gaugeElementLux = document.querySelector(".gauge__L");

        function setGaugeValue_L(gauge_L, value_L) {

            if (value_L < 1) {
                gauge_L.querySelector(".gauge__body__L").style.background = "#b4c0be";
                gauge_L.querySelector(".gauge__fill__L").style.background = "#ff8000";
            } else if (value_L > 1 && value_L <2){
                gauge_L.querySelector(".gauge__body__L").style.background = "#ff8000";
                gauge_L.querySelector(".gauge__fill__L").style.background = "#b4c0be";
            } else if (value_L > 2 && value_L <3){
                gauge_L.querySelector(".gauge__body__L").style.background = "#b4c0be";
                gauge_L.querySelector(".gauge__fill__L").style.background = "#ff8000";
            } else if (value_L > 3 && value_L <4){
                gauge_L.querySelector(".gauge__body__L").style.background = "#ff8000";
                gauge_L.querySelector(".gauge__fill__L").style.background = "#b4c0be";
            } else if (value_L > 4 && value_L <5){
                gauge_L.querySelector(".gauge__body__L").style.background = "#b4c0be";
                gauge_L.querySelector(".gauge__fill__L").style.background = "#ff8000";
            }

            a = Math.round((value_L + Number.EPSILON) * 100);
            gauge_L.querySelector(".gauge__fill__L").style.transform = `rotate(${value_L / 2}turn)`;
            gauge_L.querySelector(".gauge__cover__L").textContent = `${a.toFixed(2)} lux`;
        }
        setGaugeValue_L(gaugeElementLux, <?php echo json_encode($lux); ?> / 100);
    </script>

    <!--Script Viento-->
    <script>
        const gaugeElementViento = document.querySelector(".gauge__V");

        function setGaugeValue_V(gauge_V, value_V) {
            a = Math.round((value_V + Number.EPSILON) * 100);
            b = Math.round((value_V + Number.EPSILON) * 100) / 3.6;
            c = Math.round((value_V + Number.EPSILON) * 100) / 1.609;
            gauge_V.querySelector(".gauge__fill__V").style.transform = `rotate(${value_V / 2}turn)`;
            gauge_V.querySelector(".gauge__cover__V").textContent = `${a.toFixed(2)} km/h`;
            gauge_V.querySelector(".gauge__cover_V_M").textContent = `${b.toFixed(2)} m/s`;
            gauge_V.querySelector(".gauge__cover_V_Milla").textContent = `${c.toFixed(2)} milla/h`;
        }
        setGaugeValue_V(gaugeElementViento, <?php echo json_encode($viento); ?> / 100);
    </script>

    <!--Script Presion-->
    <script>
        const gaugeElementPresion = document.querySelector(".gauge__P");

        function setGaugeValue_P(gauge_P, value_P) {
            if (value_P < 100) {
                gauge_P.querySelector(".gauge__body__P").style.background = "#b4c0be";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#7BEE00";
            } else if (value_P > 100 && value_P <200){
                gauge_P.querySelector(".gauge__body__P").style.background = "#7BEE00";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#b4c0be";
            } else if (value_P > 200 && value_P <300){
                gauge_P.querySelector(".gauge__body__P").style.background = "#b4c0be";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#7BEE00";
            } else if (value_P > 300 && value_P <400){
                gauge_P.querySelector(".gauge__body__P").style.background = "#7BEE00";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#b4c0be";
            } else if (value_P > 400 && value_P <500){
                gauge_P.querySelector(".gauge__body__P").style.background = "#b4c0be";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#7BEE00";
            } else if (value_P > 500 && value_P <600){
                gauge_P.querySelector(".gauge__body__P").style.background = "#7BEE00";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#b4c0be";
            } else if (value_P > 600 && value_P <700){
                gauge_P.querySelector(".gauge__body__P").style.background = "#b4c0be";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#7BEE00";
            } else if (value_P > 700 && value_P <800){
                gauge_P.querySelector(".gauge__body__P").style.background = "#7BEE00";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#b4c0be";
            } else if (value_P > 800 && value_P <900){
                gauge_P.querySelector(".gauge__body__P").style.background = "#b4c0be";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#7BEE00";
            } else if (value_P > 900 && value_P <1000){
                gauge_P.querySelector(".gauge__body__P").style.background = "#7BEE00";
                gauge_P.querySelector(".gauge__fill__P").style.background = "#b4c0be";
            }

            alert(value_P);

            a = Math.round((value_P + Number.EPSILON) * 100);
            gauge_P.querySelector(".gauge__fill__P").style.transform = `rotate(${value_P / 2}turn)`;
            gauge_P.querySelector(".gauge__cover__P").textContent = `${a.toFixed(2)} hPa`;
        }
        setGaugeValue_P(gaugeElementPresion, <?php echo json_encode($presion); ?> / 100);
    </script>
</body>


</html>