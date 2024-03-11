<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMS - Chat</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div id="chat" class="chat-container">
            <div class="top">
                <h4><b>{{$user->name}}</b></h4>
            </div>

            <div class="messages">
                @include('receive',['messege'=>"Hey! what's up!"])
            </div>

            <div class="bottom">
                <form action="">
                    <input type="text" name="messege" id="messege" placeholder="Enter Messege ..." autocomplete="off">
                    <button type="submit">Send</button>
                </form>
            </div>
    </div>

    <script>

        const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}' , {cluster : 'eu'});
        const channel = pusher.subscribe('public');

        channel.bind('chat' , function(data){
            $.post("/receive" , {
                _token : '{{csrf_token()}}',
                messege : data.messege,

            }).done(function(res){
                $(".messege > .messege").last().after(res);
                $(document).scrollTop($(document).height());
            });
        });

        //broadcast messege

        $("form").submit(function (event){
            event.preventDefault();
            $.ajax({
                url : "/broadcast",
                method : "post",
                header : {
                    'X-Socket-Id' : pusher.connection.socket_id,
                },
                data : {
                    _token : '{{csrf_token()}}',
                    messege : $("form #messege").val(),
                }
            }).done(function(res){
                $(".messege > .messege").last().after(res);
                $("form #messege").val('');
                $(document).scrollTop($(document).height());

            })
        });

    </script>
</body>
</html>