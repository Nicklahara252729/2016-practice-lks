<!DOCTYPE html>
<html>
    <head>
        <title>Slide, News Ticker, Dialog Box</title>
        <script src="js/external/jquery/jquery.js" type="text/javascript"></script>
        <script>
			var nrShown;
			var Vect;
            var gambar = 3;
            var detik = 4;
            function load(){
                nrShown =0;
                Vect = new Array(gambar + 10);
                Vect[0] = document.getElementById("img1");
                Vect[0].style.visibility="visible";
                document.getElementById("S" + 0).style.visibility="visible";
                for(var i=0;i<gambar;i++){
                    Vect[i]=document.getElementById
("img" + (i+1));
                    document.getElementById("S" + i).style.visibility="visible";
                }
                document.getElementById("S" + 0).style.background="rgba(225,225,225,.5)";
                document.getElementById("SP" + 0).style.visibility="visible";
                mytime = setInterval(Timer, detik * 1000);
            }
            function Timer(){
                nrShown++;
                if(nrShown == gambar)
                    nrShown=0;
                Effect();
            }
            function next(){
                nrShown++;
                if(nrShown == gambar)
                    nrShown=0;
                Effect();
                clearInterval(mytime);
                mytime = setInterval(Timer, detik * 1000);
            }
            function prev(){
                nrShown--;
                if(nrShown == -1)
                    nrShown=gambar -1;
                Effect();
                clearInterval(mytime);
                mytime = setInterval(Timer, detik * 1000);
            }
            function satu(){
                nrShown=0;
                Effect();
                clearInterval(mytime);
                mytime = setInterval(Timer, detik * 1000);
            }
            function dua(){
                nrShown=1;
                Effect();
                clearInterval(mytime);
                mytime = setInterval(Timer, detik * 1000);
            }
            function tiga(){
                nrShown=2;
                Effect();
                clearInterval(mytime);
                mytime = setInterval(Timer, detik * 1000);
            }
			var Vect;
            function Effect(){
                for(var i=0;i<gambar;i++){
                    Vect[i].style.opacity="0";
                    Vect[i].style.visibility="hidden";
                    document.getElementById("S" + i).style.background="rgba(0,0,0,0.7)";
        document.getElementById("SP" + i).style.visibility="hidden";
                }
                    Vect[nrShown].style.opacity="1";
                    Vect[nrShown].style.visibility="visible";
                document.getElementById("S" + nrShown).style.background="rgba(225,225,225,.5)";
        document.getElementById("SP" + nrShown).style.visibility="visible";
            }
            
        </script>
        <script>
            var i =1;
            function zoom(){
                if(i==1){
                    document.getElementById("big-konten1").style.display="block";
                    i=2;
                }else{
                    document.getElementById("big-konten1").style.display="none";
                    i=1
                }
            }
            var x =1;
            function zoom2(){
                if(x==1){
                    document.getElementById("big-kontendua").style.display="block";
                    x=2;
                }else{
                    document.getElementById("big-kontendua").style.display="none";
                    x=1
                }
            }
            var z =1;
            function zoom3(){
                if(z==1){
                    document.getElementById("big-kontentiga").style.display="block";
                    z=2;
                }else{
                    document.getElementById("big-kontentiga").style.display="none";
                    z=1
                }
            }
            var d =1;
            function back(){
                if(d==1){
                    document.getElementById("big-konten1").style.display="none";
                    d=2;
                }else{
                    document.getElementById("big-konten1").style.display="block";
                    d=1 
                }
            }
            var b =1;
            function back1(){
                if(b==1){
                    document.getElementById("big-konten1").style.display="none";
                    b=2;
                }else{
                    document.getElementById("big-konten1").style.display="block";
                    b=1;
                }
            }
            var e =1;
            function backdua(){
                if(e==1){
                    document.getElementById("big-kontendua").style.display="none";
                    e=2;
                }else{
                    document.getElementById("big-kontendua").style.display="block";
                    e=1 
                }
            }
            var f =1;
            function back2(){
                if(f==1){
                    document.getElementById("big-kontendua").style.display="none";
                    f=2;
                }else{
                    document.getElementById("big-kontendua").style.display="block";
                    f=1;
                }
            }
            var g =1;
            function backtiga(){
                if(g==1){
                    document.getElementById("big-kontentiga").style.display="none";
                    g=2;
                }else{
                    document.getElementById("big-kontentiga").style.display="block";
                    g=1 
                }
            }
            var h =1;
            function back3(){
                if(h==1){
                    document.getElementById("big-kontentiga").style.display="none";
                    h=2;
                }else{
                    document.getElementById("big-kontentiga").style.display="block";
                    h=1;
                }
            }
        </script>
        <script>
            $(document).ready(function(){	
	var first = 0;
	var speed = 700;
	var pause = 3500;
	
		function removeFirst(){
			first = $('#ticker1 li:first').html();
			$('#ticker1 li:first')
			.animate({opacity: 0}, speed)
			.fadeOut('slow', function() {$(this).remove();});
			addLast(first);
		}
		
		function addLast(first){
			last = '<li style="display:none">'+first+'</li>';
			$('#ticker1').append(last)
			$('#ticker1 li:last')
			.animate({opacity: 1}, speed)
			.fadeIn('slow')
		}
	
	interval = setInterval(removeFirst, pause);
                
/*function tick1(){
                $('#ticker1 li:first').slideUp(function(){
                    $(this).appendTo()})} 
                setInterval(function(){
                    tick1()},2000);
            function tick2(){
                $('#ticker2 li:first').slideUp(function(){
                    $(this).appendTo()})} 
                setInterval(function(){
                    tick2()},2000);*/                
});
            $(function(){
               $(window).scroll(function(){
                   if($(window).scrollTop()>100){
                       $('#top').fadeIn('slow');
                   }else{
                       $('#top').fadeOut('slow');
                   }
               });
                
                $('#top').click(function(){
                    $('body,html').animate({
                        scrollTop:'0',
                    },1000);
                });
            });
        </script>
        <style>
            body{
                background: #f8f8f8;
                height: 5000px;
            }
            #left-btn,
            #right-btn{
                border: 0;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                margin-left: 5px;
                background: rgba(0,0,0,0.6);
                color: white;
                font-weight: bold;
                font-size: 20px;
                opacity: 0.3;
                transition: all 0.5s ease-in-out;
            }
            #left-btn:hover,
            #right-btn:hover{
                cursor: pointer;
                opacity: 0.9;
            }
            main{
                background: white;
                width: 60%;
                height: 300px;
                margin: 0 auto;
                box-shadow: 0px 0px 5px 0px lightgray;
                margin-top: 50px;
            }
            .content{
                height: 100%;
                float: left;
            }
            #left{
                width: 70%;
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
                width: 560px;
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
                background: rgba(0,0,0,0.5);
                border: solid 1px white;
                margin-right: 10px;
                visibility: hidden;
            }
            .in-tog li:hover{
                cursor: pointer;
            }
            .container{
                width: 40%;
                height: 150px;
                background: white;
                box-shadow: 0px 0px 5px 0px lightgray;
                margin: 0 auto;
                margin-top: 30px;
                padding: 10px;
            }
            .konten{
                width: 31.4%;
                height: 150px;
                background: red;
                float: left;
                margin-right: 10px;
            }
            .img-konten{
                width: 100%;
                height: 100%;
            }
            .big-konten{
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7);
                position: fixed;
                top: 0;
                left: 0;
                z-index: 9999;
                display: none;
                animation: fadein 1s ease-in-out;
            }
            .isi-img{
                width: 50%;
                height: 50%;
                margin:  0 auto;   
                
            }
            @keyframes zoom{
                from{
                    transform: scale(0,0);
                }
                to{
                    transform: scale(1,1);
                }
            }
            @keyframes fadein{
                from{
                    opacity: 0;
                }
                to{
                    opacity: 1;
                }
            }
            .img-big{
                width: 100%;
                height: 100%;
                margin-top: 100px;
                box-shadow: 0px 0px 10px 0px white;
                border-radius: 5px;
                animation: zoom 1s ease-in-out;
            }
            .close{
                width: 30px;
                height: 30px;
                background: white;
                border-radius: 50%;
                z-index: 9999;
                color: black;
                text-align: center;
                line-height: 30px;
                margin-top: 90px;
                margin-left: 660px;
                position: absolute;
            }
            .close:hover{
                cursor: pointer;
            }
            #right{
                width: 30%;
                height: 100%;
                overflow: hidden;
                background-image: linear-gradient(lightgray,darkgray);
                opacity: 0.8;
            }
            #right ul{
                list-style: none;
                margin-left: -40px;
                margin-top: 0px;
            }
            #right li{
                height: 50px;
                width: 96%;
                padding:5px;
                color: black;
                font-size: 12px;
                font-family: "arial";
                border-bottom: solid 1px black;
            }
            .isi-li{
                width: 100%;
                height: 50px;
            }
            .isi{
                float: left;
            }
            #li-left{
                width: 30%;
            }
            #li-right{
                width: 60%;
            }
            #li-left img{
                width: 70%;
                height: 70%;
                box-shadow: 0px 0px 5px 0px black;
                transition: all 1s ease-in-out;
            }
            #li-left img:hover{
                transform: scale(2,2) translate(30px,20px) rotate(50deg);
                cursor: pointer;
                z-index: 9999;
            }
            #top{
                position: fixed;
                right: 20px;
                bottom: 20px;
                width: 50px;
                height: 50px;
                background: skyblue;
                color: white;
                font-size: 17px;
                text-align: center;
                line-height: 50px;
                display: none;
            }
            #top:hover{
                cursor: pointer;
            }
			.flip{
				position:fixed;
				width:100px;
				height:100px;
				right:0;
				top:0;
				transition:all 0.5s ease-in-out;
				background-image:url(img/2ign.jpg);
				background-size:100% 100%;
			}
			.in-flip{
				background-image:url(img/flip.png);
				background-size:100% 100%;
				width:240px;
				height:150px;
				transform:translate(-100px,-10px);
				transition:all 0.5s ease-in-out;
			}
			.flip:hover .in-flip{
				transform:translate(-150px,40px);
				cursor:pointer;

			}
        </style>
    </head>
    <body onload="load();">
	<div class="flip">
	<div class="in-flip"></div>
	</div>
	
        <main>
            <span id="top">
                TOP
            </span>
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
                        <button type="button" id="left-btn" onclick="prev()"><</button>
                    </div>
                    <div class="in-tog" id="tog-mid">
                        <ul>
                        <li id="S0" onclick="satu()"></li>
                        <li id="S1" onclick="dua()"></li>
                        <li id="S2" onclick="tiga()"></li>
                    </ul>
                    </div>
                    <div class="in-tog" id="tog-right">
                        <button type="button" id="right-btn" onclick="next()">></button>
                        </div>
                    
                </div>
            </div>
            <div class="content" id="right">
                <ul id="ticker1">
                    <li>
                        <div class="isi-li">
                            <div class="isi" id="li-left">
                                <img src="img/Chrysanthemum.jpg">
                            </div>
                            <div class="isi" id="li-right">
                                deskripsi gambar pertama
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="isi-li">
                            <div class="isi" id="li-left">
                                <img src="img/Chrysanthemum.jpg">
                            </div>
                            <div class="isi" id="li-right">
                                deskripsi gambar kedua
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="isi-li">
                            <div class="isi" id="li-left">
                                <img src="img/Tulips.jpg">
                            </div>
                            <div class="isi" id="li-right">
                                deskripsi gambar ketiga
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="isi-li">
                            <div class="isi" id="li-left">
                                <img src="img/Penguins.jpg" >
                            </div>
                            <div class="isi" id="li-right">
                                deskripsi gambar kepempat
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="isi-li">
                            <div class="isi" id="li-left">
                                <img src="img/Tulips.jpg">
                            </div>
                            <div class="isi" id="li-right">
                                deskripsi gambar ketiga
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="isi-li">
                            <div class="isi" id="li-left">
                                <img src="img/Penguins.jpg" >
                            </div>
                            <div class="isi" id="li-right">
                                deskripsi gambar kepempat
                            </div>
                        </div>
                    </li>
                </ul>
                
                </div>
        </main>
        <div class="container">
            <div class="konten" onclick="zoom()">
                <img src="img/Chrysanthemum.jpg" class="img-konten">
            </div>
            <div class="konten" onclick="zoom2()">
                <img src="img/Tulips.jpg" class="img-konten">
            </div>
            <div class="konten" onclick="zoom3()">
                <img src="img/Penguins.jpg" class="img-konten">
            </div>
        </div>
        <div class="big-konten" id="big-konten1" onclick="back()">
            <div class="isi-img">
                <div class="close" onclick="back1()">X</div>
            <img src="img/Chrysanthemum.jpg" class="img-big">
            </div>
            </div>
        <div class="big-konten" id="big-kontendua" onclick="backdua()">
            <div class="isi-img">
                <div class="close" onclick="back2()">X</div>
            <img src="img/Tulips.jpg" class="img-big">
            </div>
            </div>
        <div class="big-konten" id="big-kontentiga" onclick="backtiga()">
            <div class="isi-img">
                <div class="close" onclick="back3()">X</div>
            <img src="img/Penguins.jpg" class="img-big">
            </div>
            </div>
    </body>
</html>