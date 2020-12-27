<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chat</title>
    <style type = "text/css">
    body{
      text-align: center;
      text : center;
    }
      .chat_log{ width: 50%; height: 400px; }
      .name{ width: 10%; }
      .message{ width: 30%; }
      .chat{ width: 10%; }

    </style>
  </head>
    <header>
         <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
    </header>
    <?php
    	 if (!$userid )
    	{
    		echo("<script>
    				alert('로그인 후 이용해주세요!');
    				history.go(-1);
    				</script>
    			");
    		exit;
    	}
    ?>
    <body>
    <div>
      <h4> COMNET  CHATTING </h4>
      <details>
        <summary> 주의 사항 </summary>
        <p> 공통으로 사용하는 채팅이니 욕설은 자제해주세요 </p>
        <p> 귓속말을 하실려면 "00에게 귓속말하기 "를 입력하고 바로 내용을 입력해주세요</p>
      </details>
    </div>

    <div>
      <textarea id="chatLog" class="chat_log" readonly></textarea>
    </div>
    <form id="chat">
      <input id="name" class="name" type="text" readonly>
      <input id="message" class="message" type="text">
      <input type="submit" class="chat" value="chat"/>
    </form>
    <div id="box" class="box">
    <script src="http://58.65.99.38:9000/socket.io/socket.io.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.js"></script>
    <script>
      var socket = io.connect("http://58.65.99.38:9000");
      socket.emit("join", "<?php echo $username ?>");
      $('#chat').on('submit', function(e){
        socket.emit('send message', $('#name').val(), $('#message').val());
        $('#message').val("");
        $("#message").focus();
        e.preventDefault();
      });
      $("#msgbox").keyup(function(event) {
          if (event.which == 13) {
              socket.emit('send_msg',{to:$('#to').val(),msg:$('#msgbox').val()});
              $('#msgbox').val('');
          }
      });
      socket.on('receive message', function(msg){
        $('#chatLog').append(msg+"\n");
        $('#chatLog').scrollTop($('#chatLog')[0].scrollHeight);z
      });
      socket.on('change name', function(name){
        $('#name').val(name);
      });
      socket.on('new_disconnect', function(name){  // 채팅방 접속이 끊어졌을 때
      $('#chatLog').append(name + '님이 떠났습니다.\n');
      });

      socket.on('new_connect', function(name){  // 채팅방에 접속했을 때
      $('#chatLog').append(name + '님이 접속했습니다.\n');
      });
      socket.on('new',function(data){
            console.log(data.nickname);
            $('#nickname').val(data.nickname);
        });
      socket.on('userlist',function(data){
            var users = data.users;
            console.log(users);
            console.log(data.users.length);
            $('#to').empty().append('<option value="ALL">ALL</option>');
            for(var i=0;i<data.users.length;i++){
                $('#to').append('<option value="'+users[i]+'">'+users[i]+"</option>");
            }
        });
    </script>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
    </footer>
  </body>
</html>
