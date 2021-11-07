<!doctype html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <style>
        .login{
            width: 200px;
            height: 200px;
            background: #f8f8f8;
        }
        .id{
            width: 100%;
            height: 35px;
            border: solid 1px lightgray;
            border-radius: 3px;
        }
        
        .left{
            width: 10%;
            height: 100%;
            background: white;
            float: left;
            line-height: 30px;
            border-right: solid 1px lightgray;
        }
        input{
            border: 0;
            width: 90%;
            height: 100%;
            padding-left: 5px;
            padding-right: 5px;
        }
        #hide1{
            display: none;
        }
    </style>
    <script>
        var i=1;
        function visi(){
            if(i==1){
            document.getElementById('id').type="text";
                i=2;
            }else{
                document.getElementById('id').type="password";
                i=1;
            }
        }
        
        function show(){
            var msk = document.getElementById('id').value;
            if(msk.length > 0){
                document.getElementById('hide1').style.display="block";
            }else{
                document.getElementById('hide1').style.display="none";
            }
        }
        
    </script>
    <body>
        <div class="login">
            
        <form target="_self" enctype="multipart/form-data" name="regis" id="regis" method="post">
            <div class="id">
            <div class="left" onclick="visi();"><span class="glyphicon glyphicon-eye-open" ></span></div><input type="password" id="id" name="id" onblur="show();" onchange="show();" onfocus="show()" placeholder="Masukkan ID"><br>
                <span class="glyphicon glyphicon-ok" id="hide1"></span>
                </div>
        </form>
            </div>
    </body>
</html>