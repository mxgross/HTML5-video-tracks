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

            <div id="display"></div>

            <script src="js/videoWithTextAd.js"></script>
        </div>
        
        <button onclick="history.back();">back</button>
    </body>
</html>