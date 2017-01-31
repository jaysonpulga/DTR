<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login Security</title>
    <meta name="description" content="">
    <meta name="author" content="">

	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="js/jquery.alerts.js" type="text/javascript"></script>
	
    <script src="js/bootstrap.min.js"></script>
    <link href="js/bootstrap.min.css" rel="stylesheet">
	<link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

</head>
<body>



  <div class="container">
   
  
    <div class="content">
      <div class="row">
        <div class="login-form">
				
			<h2>Admin -Page</h2>
            <fieldset>
              <div class="clearfix">
                <input type="text" id="username" name="username" placeholder="username">
              </div>
              <div class="clearfix">
                <input type="password" id="Password" name="Password" placeholder="Password">
              </div>
			  	<br>
              <button class="btn btn-info"  onclick='log_out()' name="submit1" title="Click here to login in the system.">
			  login</button>
			 
			 
			 <button class="btn btn-info"  onclick='back()' name="submit1" title="Click here to login in the system.">
			  Back main page-></button>
         
			</fieldset>
        
        </div>
      </div>
    </div>
  </div> <!-- /container -->
  
<script>


function back()
{
	
	window.location = "index.php";
}

function log_out()
{
	
		var username=$("#username").val();	
		var password=$("#Password").val();	
	
		
		var errormsg="Please Input the following fields: \n",emsg= errormsg.length,form_cont=$("#item_form");
		
		if($("#username").val() == ""){
			errormsg+="- Input Username \n";
		}
		if($("#Password").val() == ""){
			errormsg+="- Input Password \n";
		}
		
		
		if(errormsg.length==emsg){
	
	
	
			$.ajax({
				url: 'main_function.php',
				data: {'request':'ajax','action':'admin_login','username':username,'password':password},
				beforeSend: function(){		
				}, 
				success : function(reply){
					
				
					if(reply == "login!"){
						
					
						alert("Successful");
						
						
						window.location = "Admin_mainpage.php";
					} else {
						jAlert(reply,"Alert Dialog");
					} 
					
				}, 
				error: function(xhr, status, error) {
					console.log(xhr.responseText+" "+status+" "+error )
				}
			});
		}
		
		else{
			jAlert(errormsg,"Alert Dialog");
			event.preventDefault();
		}
	
}	

</script>
  
  


  


 </body>
</html>

<style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 350px;
      }

      /* The white background content wrapper */
      .container > .content {
        //background-color: #fff;
		background-color: lightgreen;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }
		
		
	.head2r {
	font-size : 18pt;
	font-family : Arial Black;
	color : 'Red';
	text-decoration: none;
}			
</style>
