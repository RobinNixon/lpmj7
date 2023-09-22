const http = require('http')

const server = http.createServer((request, response) =>
{
  let status = 200
  let output = '404 Not Found'
  
  switch(request.url)
  {
    case '/hello.html': output = 'Hello there'
                        break
    case '/bye.html':   output = 'Goodbye'
                        break
    default:            status = 404
  }

  response.writeHead(status, {'Content-Type': 'text/html'})
  response.end(output)
})

console.log('Server running...')
server.listen(80)
