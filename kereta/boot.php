<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>
        <link href="style.css" rel="stylesheet">
        <link href="../css/responsive.css" rel="stylesheet">
        <script>
            var i;
            i=1;
            function tampil(){
                if(i==1){
                    
                    document.getElementById('idlogin').style.display="block";
                    i=2;
                }
                else{
                    document.getElementById('idlogin').style.display="none";
                    i=1;
                }
            }
        </script>
    </head>
    <body>
        <button type="button" onclick="tampil();">click</button>
        <div class="login" id="idlogin">
            <div class="content-login">
                <div class="isi-login" id="top-login"></div>
                <div class="isi-login" id="bottom-login"></div>
            </div>
        </div>
        <header>
            <div class="header-atas">
                <div class="content-header">
                    
                </div>
            </div>
            <div class="header-tengah">
                <div class="content-header">
                    <div class="isi-ht" id="ht-satu"></div>
                    <div class="isi-ht" id="ht-dua"></div>
                    <div class="isi-ht" id="ht-tiga"></div>
                </div>
            </div>
            <div class="header-bawah">
                <div class="content-header">
                    <div class="isi-hb" id="hb-satu"></div>
                                  <div class="isi-hb" id="hb-dua"></div>
                                  <div class="isi-hb" id="hb-tiga"></div>
                                  <div class="isi-hb" id="hb-empat"></div>
                                  <div class="isi-hb" id="hb-lima"></div>
                                  <div class="isi-hb" id="hb-enam"></div>
                </div>
            </div>
        </header>
        <main>
            <div class="content">
                <div class="in-content" id="top-content">
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                    <div class="isi-content"></div>
                </div>
                <div class="in-content" id="bottom-content">
                </div>
            </div>
        </main>
        <footer>
            <div class="footer-atas">
                <div class="cf-atas">
                    <div class="isi-fa" id="fa-satu"></div>
                    <div class="isi-fa" id="fa-dua"></div>
                    <div class="isi-fa" id="fa-tiga"></div>
                </div>
            </div>
            <div class="footer-bawah">
                <div class="cf-bawah"></div>
            </div>
        </footer>
    </body>
</html>