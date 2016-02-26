<!DOCTYPE html>
  <html>
  <head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
  <h1>Add a quote</h1>
  <div id = "add_div">
    <!--  A single form for adding a quote along with the author. -->  
  <form action="showQuotes.php" method = "post">
  Quote:
  <textarea name="quote_added" id = "quote_added" rows="10" cols="100">
  </textarea>
  <br><br>
  Author:
  <input type="text" name="author_added" id="author_added">
  <br><br>
  <input type="submit" name = "add_quote" value="Add Quote">
  </form>
</div>
  </body>
  </html>
