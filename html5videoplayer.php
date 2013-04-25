<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <title>HTML 5 Video Player Demo</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <style>
            body {
                font-family: 'Roboto', sans-serif;
            }

            .clear {
                clear: both;
            }

            video {
                width: 100%;
                height: 100%;
            }

            .videoWrap {
                width: 640px;
                height: 362px;
            }

            .controls {
                background-color: #ef3b18;
                width: 100%;
            }

            .controls span {
                background-image: url("images/playericons.png");
                background-repeat: no-repeat;
                background-position: -3px -1px;
                height: 30px;
                width: 30px;
                display: block;
                float: left;
            }

            .controls .playPauseButton {
                background-position: -108px -1px;
            }

            .controls .playPauseButton.pause {
                background-position: -143px -1px;
            }

            .controls .stopButton {
                background-position: -178px -1px;
            }

            .timeline {
                width: 300px;
                height: 20px;
                font-size: 14px;
                margin: 4px 5px;
                display: block;
                float: left;
                border: 1px solid #FFF;
                text-align: center;
                color: #000;
                position: relative;
                overflow: hidden;
            }

            .timeline .statusbar {
                height: 100%;
                background-color: #FFF;
                display: block;
                position: absolute;
                top: 0;
                left: 0;
            }

            .timeText {
                color: #FFF;
                font-size: 15px;
                padding: 4px 0 0 0;
                float: left;
            }

            .hoverDiv {
                position: absolute;
                top: 0;
                left: 0;
                width: 2px;
                height: 100%;
                background-color: #000;
                display: none;
            }

            .timeline:hover .hoverDiv, .volume:hover .hoverDiv{
                display: block;   
            }

            .volume {
                margin-top: 4px;
                float:left;
                position: relative;
            }

            .volumeBackground {
                border-style: solid solid none none;
                border-color: transparent #FFF transparent #FFF;
                border-width: 22px 60px;
                height: 0;
            }

            .volume .current {
                position: absolute;
                top: 0;
                left: 0;
                width: 3px;
                height: 100%;
                background-color: gray;
            }

            .controls .muteButton {
                background-position: -213px -1px;
            }

            .controls .muteButton.muted {
                background-position: -248px -2px;
            }


        </style>
    </head>


    <body>
        <div id="main">

            <div class="videoWrap">
                <video>
                    <source src="video/html5_video.mp4" type="video/mp4"/>
                </video>
                <div class="controls">
                    <span class="playPauseButton"><!--PLAY--></span>
                    <span class="stopButton"><!--Stop--></span>
                    <div class="timeline"> <div class="statusbar"> <div class="hoverDiv"></div> </div> </div>
                    <div class="timeText"></div>
                    <span class="muteButton"><!--Mute--></span>
                    <div class="volume"><div class="volumeBackground"></div> <div class="current"></div> <div class="hoverDiv"></div> </div>

                    <div class="clear"></div>
                </div>
            </div>

        </div>

        <script>

            var video = $('video')[0];

            //GLOBALS

            // Listener
            $('.playPauseButton').click(function() {
                playOrPause($(this));
            });

            $('.stopButton').click(function() {
                stop($(this));
            });

            $('.muteButton').click(function() {
                toggleMute($(this));
            });
            ///////////

            function playOrPause(button) {
                console.log("(un)paused");
                video = button.parent().parent().find('video')[0];
                button.toggleClass('pause');

                if (video.paused) {
                    video.play();
                } else {
                    video.pause();
                }

            }

            function stop(button) {
                console.log("stoped");
                video = button.parent().parent().find('video')[0];
                video.pause();
                video.currentTime = 0;
                button.parent().find('.playPauseButton').removeClass('pause');
            }

            function toggleMute(button) {
                console.log("(un)muted");
                video = button.parent().parent().find('video')[0];
                button.toggleClass('muted');

                if (video.muted) {
                    video.muted = false;
                } else {
                    video.muted = true;
                }
            }

            // works only with 1 video per page if used like this!
            function drawStatusBar() {
                videoElement = $('video');
                video = $('video')[0];
                var statusVal = (video.currentTime / video.duration * 100);
                $('.statusbar').width(statusVal + '%');
                $('.timeText').text(video.currentTime.toFixed(0) + ' / ' + video.duration.toFixed(0));
                getVolume(video);
            }
            setInterval(drawStatusBar, 100);

            // When video has ended
            $('video')[0].addEventListener('ended', function(e) {
                button = $(e.target).parent().find('.stopButton');
                stop(button);
            });

            // renders the timeline cursor
            $(".timeline").mousemove(function(event) {
                x = event.pageX - $(this)[0].offsetLeft;
                $(this).find('.hoverDiv').css({'left': +x + 'px'});

                $(this).click(function() {
                    curserPositionInPercent = x / $(this).width();
                    video = $(this).parent().parent().find('video')[0];
                    newTime = (curserPositionInPercent) * video.duration;
                    video.currentTime = newTime;
                });

            });

            // renders the volume cursor
            $(".volume").mousemove(function(event) {

                x = event.pageX - $(this)[0].offsetLeft;
                $(this).find('.hoverDiv').css({'left': +x + 'px'});

                $(this).click(function() {
                    video = $(this).parent().parent().find('video')[0];
                    video.volume = (x / $(this).width());
                });

            });


            function getVolume(video) {
                video.volume;
                $(".volume").find('.current').css({'left': (video.volume * 100) + '%'});
            }


        </script>

    </body>

</html>