<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estructuras de Control con Blade</title>
</head>
<body>
    @php
        function sumar($num1, $num2){
            return $num1+$num2;
        }
    @endphp

    <p>{{sumar(15,8)}}</p>
</body>
</html>