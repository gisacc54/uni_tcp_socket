<?php
$host = "127.0.0.1";
$port = 20205;
set_time_limit(0);

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");

$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");
echo "Listening for connection";

class Chat{
    function readLine(){
        return rtrim(fgets(STDIN));
    }
}

do{
    $accept = socket_accept($socket) or die("Could not accept incoming connection");
    $msg = socket_read($accept,1024) or die("Fail to read");
    $msg = trim($msg);
    echo "Client says: \t".$msg."\n\n";
    $line = new Chat();
    echo "Enter Reply:\t";
    $reply = $line->readLine();
    socket_write($accept,$reply,strlen($reply)) or die("Could not write \n");

}while(true);

socket_close($accept,$socket);