<!doctype html>
<html>
    <head>
        <link href="js/jquery-ui.css" rel="stylesheet">
    </head>
    <body>
        <input type="text" id="datepicker" onfocus="datepicker();">
        <div id=""></div>
        <select id="select">
            <option>+63</option>
            <option>+63</option>
            <option>+63</option>
            <option>+63</option>
            <option>+63</option>
        </select>
        <input type="text" required pattern="[a-z][A-z].{5,}" title="Must long">
        <button type="submit">kirim</button>
        <script src="js/external/jquery/jquery.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js" type="text/javascript"></script>
        <script type="text/javascript">
            $("#datepicker").datepicker({
                inline:true
            });
            $('#select').selectmenu();
        </script>
    </body>
</html>