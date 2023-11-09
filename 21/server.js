const http = require('http')
const url  = require('url')
const fs   = require('fs')

const server = http.createServer((request, response) =>
{
  let filename = '.' + url.parse(request.url).pathname

  fs.readFile(filename, 'utf8', (error, data) =>
  {
    let status = 200
    
    if (error)
    {
      status = 404
      data   = '404 Not Found'
    }

    response.writeHead(status, {'Content-Type': 'text/html'})
    response.end(data)
  })
})

console.log('Server running...')
server.listen(80)
