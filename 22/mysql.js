const mysql = require('mysql');

const connection = mysql.createConnection(
{
  host:     'localhost',
  user:     'node',
  password: 'letmein',
  database: 'publications'
})

connection.connect((error) =>
{
  if (error) throw error
})

let query = 'SELECT * FROM classics WHERE author="Jane Austen"'

connection.query(query, (error, results, fields) =>
{
  if (error) throw error
  
  console.log('Results:',       results.length)
  console.log('Data returned:', results)
  console.log('Author:',        results[0].author)
  console.log('Title:',         results[0].title)
  console.log('Category:',      results[0].category)
  console.log('Year:',          results[0].year)
  console.log('ISBN:',          results[0].isbn)
})

connection.end()
