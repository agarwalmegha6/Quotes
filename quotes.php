<!DOCTYPE html>
  <html>
  <head>
  <title>Quotation Data Base</title>
  <link rel="stylesheet" href="styles.css">
  </head>
  <body>
      <!--  A Single PHP Application with 2 views -->  
      <?php
	  if(isset($_GET['mode']) && $_GET['mode'] === 'new') {
	     require_once("./addQuote.php"); //View for a new quote
	  }
    else {
	     require_once("./showQuotes.php"); //View for showing the quote
	  }
	?>
  </body>
  </html>