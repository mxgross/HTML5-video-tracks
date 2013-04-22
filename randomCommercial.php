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

        <style>
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
        } else {
            $randomCommercialSrc = ($files[$randomNbr]);
            $controls = '';

            echo 'Random number: ' . $randomNbr . ' so "' . $files[$randomNbr] . '" will be played.';
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

                <video id="video">
                    <source src="video/html5_video.mp4" type="video/mp4" <?php echo $controls ?> />
                    HTML5 Video not supported 
                </video>

                <?php
                if (isset($randomCommercialSrc)) {
                    // show a skip link
                    echo '<div class="skipCommercial">Skip commercial</div>';
                } else {
                    // show controls of main video
                    echo '<script>$("video")[0].setAttribute("controls", "controls");</script>';
                }
                ?>

            </div>



            <script>

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
                    $('#commercial').remove();
                    $('video')[0].play();
                    $('video')[0].setAttribute("controls", "controls");
                    $('.skipCommercial').remove();
                }

            </script>

            <button onclick="history.back();">back</button>
        </div>

    </body>
</html>
