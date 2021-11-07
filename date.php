<!doctype html>
<html>
    <head>
        <title>Date</title>
        
        <link href="css/ui.all.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        Masukkan Tanggal : <input id="tanggal" type="text">
        <ul id="menu">
            <li>+62</li>
        </ul>
        <script src="js/jquery-1.3.2.js" type="text/javascript"></script>
        <script src="js/ui.core.js" type="text/javascript"></script>
        <script src="js/ui.datepicker.js" type="text/javascript"></script>
        <script>
            
                $("#tanggal").datepicker();
                $('#menu').selectmenu();
            
        </script>
    </body>
</html>