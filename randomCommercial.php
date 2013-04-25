<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Random Commercial Demo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <style>
            body {
                font-family: Arial;
            }
            .videoWrap {
                position: relative;
                width: 640px;
                height: 370px
            }

            video {
                width: 640px;
                height: 370px;
            }

            #commercial {
                position: absolute;
                width: 640px;
                height: 370px;
                background-color: black;
            }

            .skipCommercial {
                display: none;
                position: absolute;
                bottom: 30px;
                left: 0;
                padding: 5px 20px;
                background-color: rgba(0, 0, 0, 0.6);
                color: white;
                font-family: Arial;
                border: 1px dotted gray;
            }

            .skipCommercial:hover {
                text-decoration: underline;
            }

            .statusbar {
                position: absolute;
                display: block;
                height: 3px;
                background-color: orangered;
                bottom: 3px;
                right: 0;
                border: 1px solid white;
                text-align: center;
            }
            .statusbar span{
                display: block; 
                float: right;
                margin-top: -15px;
                font-size: 12px;
                color: white;
                min-width: 100px;
            }


        </style>

    </head>
    <body>

        <?php
        $dir = "video/ad";
        $dh = opendir($dir);
        $files = array();
        $i = 0;
        echo 'Videos found in "' . $dir . '": <ul>';
        while (false !== ($filename = readdir($dh))) {
            if (!in_array($filename, array('.', '..')) and !is_dir($filename)) {
                $files[] = $filename;
                echo '<li>' . $filename . '</li>';
                $i++;
            }
        }
        echo '</ul>';

        $randomNbr = mt_rand(0, $i);

        if ($randomNbr == $i) {
            // dont show a commercial this time
            $controls = 'controls';

            echo 'Random number: ' . $randomNbr . ' so you will get the clip without ad ;) ';
            echo '<script>var commercialActive = false;</script>';
        } else {
            $randomCommercialSrc = ($files[$randomNbr]);
            $controls = '';

            echo 'Random number: ' . $randomNbr . ' so "' . $files[$randomNbr] . '" will be played.';
            echo '<script>var commercialActive = true;</script>';
        }
        ?>

        <div id="container">
            <div class="videoWrap">

                <?php
                if (isset($randomCommercialSrc)) {
                    echo '<video id="commercial" autoplay>';
                    echo '<source src="video/ad/' . $randomCommercialSrc . '" type="video/mp4"/>';
                    echo 'HTML5 Video not supported</video>';
                }
                ?>

                <video id="video" <?php echo $controls ?>>
                    <source src="video/html5_video.mp4" type="video/mp4" />
                    HTML5 Video not supported 
                </video>

                <?php
                if (isset($randomCommercialSrc)) {
                    // show a skip link
                    echo '<div class="statusbar"></div>';
                    echo '<div class="skipCommercial">Skip commercial</div>';
                } else {
                    // show controls of main video
                    echo '<script>$("video")[0].setAttribute("controls", "controls");</script>';
                }
                ?>

            </div>



            <script>

                window.onload = function() {
                    $(document).mousemove(function(e) {
                        mouseX = e.pageX;
                        mouseY = e.pageY;
                        $('.hoverDiv').css('left', (mouseX - $('.timeline')[0].offsetLeft) + 'px');
                    });
                };

                $(document).ready(function() {


                    var timeWhenSkipLinkWillBeShown = 3; // in sec.

                    var videoElement = $("video");
                    var video = videoElement[0];
                    video.load();
                    video.play();

                    $('.skipCommercial').click(function() {
                        commercialEnded();
                    });

                    $('#commercial')[0].addEventListener('ended', function() {
                        commercialEnded();
                        console.log("commercial ended");
                    });

                    function commercialEnded() {
                        commercialActive = false;
                        $('#commercial').remove();
                        $('video')[0].play();
                        $('video')[0].setAttribute("controls", "controls");
                        $('.skipCommercial').remove();
                        $('.statusbar').remove();
                    }

                    video = $('#commercial')[0];
                    var currentTime = 0, duration = 0;
                    function getDuration() {
                        currentTime = (video.currentTime);
                        duration = (video.duration);
                        percentage = (currentTime / duration) * 100;
                        percentage;

                        drawStatusBar(percentage, currentTime, duration);

                        if (currentTime >= timeWhenSkipLinkWillBeShown) {
                            $('.skipCommercial').fadeIn();
                        }
                    }
                    setInterval(getDuration, 100);


                    function drawStatusBar(percentage, currentTime, duration) {
                        var width = 100 - percentage;
                        $('.statusbar').width(width + '%');
                        $('.statusbar').html('<span>Commercial: ' + calcSecondsInMinutes(duration - currentTime) + '</span>');
                    }

                    function calcSecondsInMinutes(secVal) {
                        var minVal = Math.floor(secVal / 60);  // The minutes
                        secVal = (secVal % 60).toFixed(0);
                        return (minVal + ':' + secVal);
                    }





                });

            </script>

            <button onclick="history.back();">back</button>
        </div>

    </body>
</html>
