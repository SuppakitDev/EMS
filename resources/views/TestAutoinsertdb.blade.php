<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h1>Now javascript function is working for insert data every 5 minute!</h1>
</body>
</html>
<script>

setInterval(function() {

    var date = new Date();
    var str = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " +  date.getHours() + ":" + date.getMinutes() + ":" + "00";

    $.ajax({
      type: "GET",
      url: "/AutoEmsInsertDis01?date="+str,
    });

    $.ajax({
      type: "GET",
      url: "/AutoEmsInsertDis02?date="+str,
    });

}, 300000); 
</script>