<!doctype html>
<html>
    <head>
       <style>
           .tampil{
               width: 100px;
               height: 50px;
               border: solid 1px;
               float: left;
           }
        </style>
    </head>
    <body>
        <?php
        include"koneksi.php";
        $sql=mysql_query("select * from user");
        while ($r=mysql_fetch_array($sql)){
            echo"<div class='tampil'>
            $r[username];
        </div>"; 
        }
        ?>
        
    </body>
</html>
