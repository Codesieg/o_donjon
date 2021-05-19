## Activated websocket
# To do once :
systemctl enable serverSocket.service

## start websocket server 

sudo systemctl start serverSocket.service 

## stop websocket server

sudo systemctl stop serverSocket.service 

## restart websocket server

sudo systemctl restart serverSocket.service 

## Disable websocket

sudo systemctl disable serverSocket.service 

## Check status of websocket server

sudo systemctl status serverSocket.service 

## Testing connection :

var conn = new WebSocket('wss://odonjon.fr/wss2/');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.send('Hello World!');