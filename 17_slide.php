<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Slide, News Ticker, Dialog Box</title>
        <link href="js/jquery-1.3.2.js" type="text/css">
        <script>
            var gambar = 3;
            var detik = 4;
            function load(){
                nrShown =0;
                Vect = new Array(gambar + 10);
                Vect[0] = document.getElementById("img1");
                Vect[0].style.visibility="visible";
                for(var i=0;i<gambar;i++){
                    Vect[i]=document.getElementById
("img" + (i+1));
                }
                mytime = setInterval(Timer, detik * 1000);
            }
            function Timer(){
                nrShown++;
                if(nrShown == gambar)
                    nrShown=0;
                Effect();
            }
            function Effect(){
                for(var i=0;i<gambar;i++){
                    Vect[i].style.opacity="0";
                    Vect[i].style.visibility="hidden";
                }
                    Vect[nrShown].style.opacity="1";
                    Vect[nrShown].style.visibility="visible";
            }
        </script>
        <style>
            main{
                width: 60%;
                height: 300px;
                margin: 0 auto;
                margin-top: 50px;
                border: solid 1px;
            }
            .content{
                height: 100%;
            }
            #left{
                width: 70%;
                border-right: solid 1px;
            }
            #imgs{
                width: 100%;
                height: 100%;
            }
            #imgs img{
                width: 567px;
                height:300px;
                position: absolute;
                visibility: hidden;
                transition: all 1s ease-in-out;
            }
            #caption{
                width: 567px;
                height: 70px;
                background: rgba(0,0,0,0.5);
                position: absolute;
                z-index: 9999;
                margin-top: -70px;
            }
            #caption p{
                position: absolute;
                color: white;
                visibility: hidden;
                margin-left: 50px;
            }
            #toggle{
                width: 567px;
                height: 40px;
                position: absolute;
                margin-top: -150px;
            }
            .in-tog{
                float: left;
                height: 100%;
            }
            #tog-left,
            #tog-right{
                width: 10%;
            }
            #tog-mid{
                width: 80%;
            }
            .in-tog ul{
                list-style: none;
                margin-left: 130px;
                margin-top: 10px;
            }
            .in-tog li{
                float: left;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: rgba(225,225,225,.5);
                border: solid 1px white;
                margin-right: 10px;
                visibility: hidden;
            }
            .in-tog li:hover{
                cursor: pointer;
            }
            #left,
            #right{
                border: 0;
            }
        </style>
    </head>
    <body onload="load();">
        <main>
            <div class="content" id="left">
                <div id="imgs">
                <img src="img/Chrysanthemum.jpg" id="img1">
                <img src="img/Tulips.jpg" id="img2">
                <img src="img/Penguins.jpg" id="img3">
                </div>
                <div id="caption">
                    <p id="SP0">Berita satu ! Ini adalah berita satu</p>
                    <p id="SP1">Berita dua ! Ini adalah berita dua</p>
                    <p id="SP2">Berita tiga ! Ini adalah berita tiga</p>
                </div>
                <div id="toggle">
                    <div class="in-tog" id="tog-left">
                        <button type="button" id="left" onclick="prev()"><</button>
                    </div>
                    <div class="in-tog" id="tog-mid">
                        <ul>
                        <li id="S0" onclick="satu()"></li>
                        <li id="S1" onclick="dua()"></li>
                        <li id="S2" onclick="tiga()"></li>
                    </ul>
                    </div>
                    <div class="in-tog" id="tog-right">
                        <button type="button" id="right" onclick="next()">></button>
                        </div>
                    
                </div>
            </div>
            <div class="content" id="right"></div>
        </main>
    </body>
</html>