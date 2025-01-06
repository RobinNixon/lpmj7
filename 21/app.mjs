import * as http from 'http'
import { helloWorld } from './helloWorld.mjs'

const server = http.createServer((request, response) =>
{
  response.writeHead(200, {'Content-Type': 'text/html'})
  response.end(helloWorld())
})

const port = 8000
server.listen(port, () => console.log('Server listening on port ' + port))
