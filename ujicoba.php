<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type"  content="text/html; charset=utf-8">
        <title>coba</title>
        <style>
            *{
                font-family: "calibri";
                font-size: 15px;
            }
            input[type="text"],input[type="password"],input[type="file"],select{
                width: 200px;
                height: 30px;
                border-radius: 3px;
                border: solid 1px lightgray;
                padding-left: 10px;
            }
            button{
                width: 105px;
                height: 30px;
                border: 0;
                color: white;
                border-radius: 3px;
            }
            .tombolmerah{
                background: red;
            }
            .tombolbiru{
                background: blue;
            }
            .tombolmerah:active{
                background-image: linear-gradient(#f00,#f36);
            }
            .tombolbiru:active{
                background-image: linear-gradient(#0c0,#0f0);
            }
        </style>
        <script>
                
            function cekpass(){
                var pass=document.getElementById("password").value;
                var pass1=document.getElementById("password").value;
                var pass2=document.getElementById("confirm").value;
                if(pass.length <8 && pass1!=pass2){
                    document.getElementById("msgpass").style.color="red";
                    document.getElementById("msgpass").innerHTML="must long";
                    document.getElementById("password").focus();
                    return false;
                }
                else if(pass.length >=8 && pass2.length <=0){
                    document.getElementById('msgpass').style="color:#00ff00";
                    document.getElementById('msgpass').innerHTML="pass good";
                }
                else if(pass.length >=8 && pass1!=pass2){
                    document.getElementById('msgpass').style="color:#ff0000";
                    document.getElementById('msgpass').innerHTML="not same";
                    document.getElementById('confirm').focus();
                    return false;
                }
                else if(pass.length >=8 && pass1==pass2){
                    document.getElementById('msgpass').style="color:#0000ff";
                    document.getElementById('msgpass').innerHTML="match";
                }
                return true;
            }
            function cekfile(){
                var filein=document.getElementById("photo");
                var info=filein.files[0];
                var sizefile=info.size;
                if(sizefile > 2097152){
                    document.getElementById('msgphoto').style="color:#ff0000;";
                    document.getElementById('msgphoto').innerHTML="maximum file size : 2mb. size file :" +(sizefile/1048576)+"MB.";
                    document.getElementById('msgphoto').focus();
                    return false;
                }else{
                    document.getElementById('msgphoto').style="color:#00ff00;";
                    document.getElementById('msgphoto').innerHTML="file size accept :"+(sizefile/1024)+"KB";
                }
                return true;
            }
        </script>
    </head>
    <body>
        <form id="inputuser" name="inputuser" action="#" target="_self" method="post" enctype="multipart/form-data">
            <b>FORM INPUT USER</b>
            <hr align="left" width="215px"><br>
            <label for="nama">FULL NAME :</label><br>
            <input type="text" name="fullname" id="fullname" placeholder="Full Name"  required><br>
            <label for="username">YOUR USERNAME :</label><br>
            <input type="text" name="username" id="username" placeholder="Your Username" required><br>
            <label for="password">YOUR PASSWORD ACCESS :</label><br>
            <input type="password" name="password" id="password" required onblur="cekpass();"><br>
            <label for="confirm">CONFIRM PASSWORD :</label><br>
            <input type="password" name="confirm" id="confirm"  required onblur="cekpass();" onfocus="cekpass();"><br>
            <div id="msgpass"></div><br><br>
            <label for="email">YOUR EMAIL :</label><br>
            <input type="text" name="email" id="email" placeholder="Your Email" required onfocus="cekpass();"><br>
            <label for="level">PILIH HAK AKSES :</label><br>
            <select id="level" name="level">
                <?php
                $level=array('admin','user','member');
                for($i=0;$i<=2;$i++){
                    echo"
                    <option value='$level[$i]'>
                    $level[$i]
                    </option>
                    ";
                }
                ?>
            </select><br>
            <label for="photo">SELECT YOUR PHOTO PROFILE :</label><br>
            <input type="file" name="photo" id="photo" onblur="cekfile();" onchange="cekfile();"><br>
            <div id="msgphoto"></div><br><br>
            <button type="submit" id="submit" class="tombolbiru">Simpan Data</button>
            <button type="reset" id="reset" class="tombolmerah" onclick="history.back();">Batalkan</button>
        </form>
    </body>
</html>