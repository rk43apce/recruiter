 
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | PHP Script for convert or export HTML text to MS Word File</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  


                <br />  
                <h3 align="center" style="color: red;" >PHP Script for convert or export HTML text to MS Word File</h3>  
                <br />  
                <form method="post" action="export.php">  
                     <label>Enter Title</label>  
                     <input type="text" name="heading" class="form-control" />  
                     <br />  
                     <label>Enter Description in HTML Formate</label>  
                     <textarea name="description" class="form-control" rows="10"></textarea>  
                     <br />  
                     <input type="submit" name="create_word" class="btn btn-info" value="Export to Word" />  
                </form>  
           </div>  
      </body>  
 </html>  