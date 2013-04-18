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
        <script src="js/functions.js"></script>

        <link href="style/global.css" rel="stylesheet"/> 

    </head>
    <body>
        <div class="videoWrap">
            <video id="video1" controls>
                <source src="video/html5_video.mp4">
                <!-- The German text track is used by default -->
                <track id="entrack" label="German subtitles" kind="captions" src="track/test.vtt" srclang="de" default>
                <track id="sptrack" label="Spanish subtitles" kind="captions" src="track/es.vtt" srclang="es">
                HTML5 Video not supported 
            </video>
            
            <div class="subWrap">

            </div>
        </div>

        <div id="display"></div>

    </body>
</html>
