<!DOCTYPE html>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <style>
            body {
                font-family: Verdana, Arial;
                background-color: black;
            }

            h1 {
                color: orangered;
                font-weight: normal;
            }

            ul {
                float: left;
            }

            li {
                margin-bottom: 10px;
                font-size: 16px;
                color: white;
            }

            li a {
                text-decoration: none;
                color: white;
            }

            li a:hover {
                text-decoration: underline;
            }

            #preview {
                float: left;
                color: white;
                margin-left: 20px;
            }

            #preview iframe{
                width: 700px;
                height: 500px;
                overflow: hidden;
                background-color: white;
            }

        </style>
    </head>
    <body>

        <h1>Various HTML5 Video Experiments</h1>
        <ul class="examples">
            <li><a href="html5videoplayer.php">HTML5 videoplayer with custom controls</a></li>
            <li><a href="randomCommercial.php">Video with random commercial in front (JS and PHP)</a></li>
            <br>
            <li><a href="videoWithCommercial.php">Video with commercial in front (JS only)</a></li>
            <li><a href="videoWithTextAd.php">Video with different text ads (JS only)</a></li>
        </ul>

        <div id="preview">

        </div>


        <script>
            $('ul.examples li a').mouseenter(function() {
                var src = $(this).attr('href');
                console.log(src);
                $('#preview').append('PREVIEW:<br><iframe src="' + src + '"></iframe>');
            });

            $('ul.examples li a').mouseleave(function() {
                $('#preview').html('');
            });
        </script>

    </body>
</html>
