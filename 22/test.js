const http = require('http')

const server = http.createServer((request, response) =>
{
  response.writeHead(200, {'Content-Type': 'text/html'})
  response.end('Hello World')
})

console.log('Server running...')
server.listen(80)
