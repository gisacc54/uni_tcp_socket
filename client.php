<?php
$host = "127.0.0.1";
$port = 20205;
if(isset($_POST['send'])){
    $message = $_REQUEST['chat'];
    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

    $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");

    socket_write($socket, $message, 20) or die("Could not send data to server\n");

    $msg = socket_read($socket,1024) or die("Fail to read");
    $msg = trim($msg);
    $reply = "Server: \t".$msg;

    socket_close($socket);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tcp Client</title>
</head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<body>
<div class="container" >
    <div class="col-md-8 offset-2" style="background-color: #dddddd; margin-top: 100px;">
        <div class="col-md-12" style="height: 500px;">
            <?php echo @$reply;?>
        </div>
        <div class="col-md-12">
            <form class="form" method="POST">
                <div class="row">
                    <div class="col-md-10"><input name="chat" type="text" class="form-control"  placeholder="Message...."></div>
                    <div class="col-md-2" style="color: #0c5460"><input type="submit" name="send" class="btn btn-primary"/></div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
<script type="text/javascript">
	

</script>
</html>