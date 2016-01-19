<?php
//JESPER
include 'DbConnection.php';
include 'functions.php';
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="newcss.css" rel="stylesheet">
        <script>
        function showHint(str)
        {
            var xmlhttp;

            if (str.length==0)
            {
                document.getElementById("txtHint").innerHTML="";
                return;
            }
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=handleServerResponse;  //specifies which function to call, when the server answers

            function handleServerResponse()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var docroot= xmlhttp.responseXML.documentElement;
                    var names = docroot.getElementsByTagName('name');//names is a list
                    var hintDiv = document.getElementById("txtHint");
                    for(var i=0; i<names.length;i=i+1){
                        var myDiv=document.createElement('div');
                        myDiv.innerHTML=names[i].firstChild.nodeValue;
                        hintDiv.appendChild(myDiv);
                    }

                }
            }
            xmlhttp.open("GET","autocompleteDEMO.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
    </head>

    <body>
        <div class="container">
            <div class="jumbotron">
            </div>
            <div class="tables">    
                <form action="?action=newUser" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="Create a new user">
                </form>
            <form action="?action=login" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="Login">
                </form>
               <?php
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {

                        
                        case "newUser":
                            echo insert_user_form();
                            break;
                        
                        
                        case "login":
                            echo login_form1();
                            break;
                    }
                }



             
                ?>

               
                
            </div>

                
        </div> <!--end of container-->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="dist/js/bootstrap.min.js"></script>
        

    </body>



</html>



