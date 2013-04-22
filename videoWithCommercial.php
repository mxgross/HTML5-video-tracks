<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php

// function to deliver random id using the current time in ms
function getRandomId() {
    echo str_replace(' ', '', str_replace('.', '', microtime()));
}
?>

<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <link href="style/videoAdDemo.css" rel="stylesheet"/> 

    </head>
    <body>
        <div id="container">
            <div class="videoWrap">
                <video id="<?php getRandomId() ?>" controls="controls">
                    <source src="video/html5_video.mp4" type="video/mp4"/>
                    <!-- The German text track is used by default -->
                    <track label="German subtitles" mode="hidden" kind="subtitles" srclang="de" src="track/videoWithCommercial.vtt" default />
                    HTML5 Video not supported 
                </video>

                <!-- here will inVideoAds be placed -->
                <div class="inVideoAdWrap">
                </div>
            </div>

            <!-- here will the borderAds be placed -->
            <div id="borderAdWrap">
            </div>
            <div class="clear"></div>


            <script src="js/videoWithCommercial.js"></script>
        </div>
        <button onclick="history.back();">back</button>
    </body>
</html>
