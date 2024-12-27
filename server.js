var http = require('http');
var fs = require('fs');


function handleRequest(req,response) {
   response.writeHead(200,{'Content-Type' : 'text/html'});

   fs.readFile('../index.php',null,function(error,data){
   		if(error) {
   			response.writeHead(400);
   			response.write("File Not Found");
   		} else {
   			response.write(data);
   		}
   		response.end();
   });
}

var server = http.createServer(handleRequest);

 server.listen(3000, function(){
 	console.log('sedang berjalan pada port 3000');
 });