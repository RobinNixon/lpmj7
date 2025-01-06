import mysql from 'mysql2/promise'

const connection = await mysql.createConnection({
  host: 'localhost',
  user: 'node',
  password: 'letmein',
  database: 'publications'
})

try {
  const query = 'SELECT * FROM classics WHERE author = ?'
  const [results, fields] = await connection.execute(
    query,
    ['Jane Austen']
  )

  console.log('Results:',       results.length)
  console.log('Data returned:', results)
  console.log('Author:',        results[0].author)
  console.log('Title:',         results[0].title)
  console.log('Category:',      results[0].category)
  console.log('Year:',          results[0].year)
  console.log('ISBN:',          results[0].isbn)
} catch (error) {
  console.log(error)
}

connection.end()
