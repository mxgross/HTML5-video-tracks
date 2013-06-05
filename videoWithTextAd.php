<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <link href="style/global.css" rel="stylesheet"/> 

    </head>
    <body>
        <div id="container">
            <div class="videoWrap">

                <video id="video1" autoplay controls>
                    <source src="video/html5_video.mp4" />
                    <!-- The German text track is used by default -->
                    <track label="German subtitles" mode="hidden" kind="subtitles" srclang="de" src="track/videoWithTextAd.vtt" default />
                    HTML5 Video not supported 
                </video>

                <div class="subWrap">

                </div>
            </div>

            <div id="advertWrap">
                <div>Advertising:</div>
            </div>

            <div class="clear"></div>
            <h2>Current text track content:</h2>
            <textarea class="textareaOne" style="width: 950px; height: 70px"></textarea>

            <div id="display"></div>

            <script src="js/videoWithTextAd.js"></script>
        </div>

        <h2>Complete WEBVTT file content:</h2>
        <textarea style="width: 950px; height: 300px">
WEBVTT FILE

inVideoAd
00:00:02.000 --> 00:00:08.000
<div class="advertBanner">
<a href="http://www.bmw.de" target="_blank"><img src="images/bmw_ads.jpg" /></a>
</div>

borderAd
00:00:10.000 --> 00:00:13.000
<img src="http://www.netbiscuits.com/~/media/Images/Logos/netbiscuits_logo_4_180x26.gif" />

borderAd
00:00:16.000 --> 00:00:19.000
<div>This is a Opel Corsa <img width="280px;" src="http://upload.wikimedia.org/wikipedia/commons/2/2c/Opel_Corsa_C_front.jpg" /></div>
        </textarea>
    </body>
</html>
