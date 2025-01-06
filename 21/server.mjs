import http from 'http'
import url from 'url'
import { readFile } from 'fs/promises'
import { resolve, extname } from 'path'

const SCRIPT_DIRECTORY = new URL('./', import.meta.url).pathname

const server = http.createServer(async (request, response) => {
  const fpath = resolve('.' + url.parse(request.url).pathname)
  if (!fpath.startsWith(SCRIPT_DIRECTORY)) {
    response.writeHead(400, { 'Content-Type': 'text/html' })
    response.end('400 Bad Request')
    return
  }
  if (extname(fpath) !== '.html') {
    response.writeHead(400, { 'Content-Type': 'text/html' })
    response.end('Sorry, only <code>.html</code> extension is supported')
    return
  }
  try {
    const data = await readFile(fpath, 'utf8')
    response.writeHead(200, { 'Content-Type': 'text/html' })
    response.end(data)
  } catch (err) {
    response.writeHead(404, { 'Content-Type': 'text/html' })
    response.end('404 Not Found')
  }
})

const port = 8000
server.listen(port, () => console.log('Server listening on port ' + port))
