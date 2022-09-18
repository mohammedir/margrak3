<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>HI I'm here</h1>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    var pusher = new Pusher('50de759f9fcf328ef11b');
    //    channel = socket.subscribe('my-channel');
    var channel = pusher.subscribe('myChannel');
    channel.bind('my_event', function(data) {
        console.log(data);
        alert('Received my-event with message: ');
    }, { name: 'Pusher' });

</script>
</body>
</html>