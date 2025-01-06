import http from 'http'

const server = http.createServer(async (request, response) => {
  let status = 200
  let output = '404 Not Found'
  
  switch (request.url) {
    case '/hello.html': output = 'Hello there'
                        break
    case '/bye.html':   output = 'Goodbye'
                        break
    default:            status = 404
  }

  response.writeHead(status, { 'Content-Type': 'text/html' })
  response.end(output)
})

const port = 8000
server.listen(port, () => console.log('Server listening on port ' + port))
