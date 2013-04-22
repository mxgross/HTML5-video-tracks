var videoElement = document.querySelector("video");
var textTrack = videoElement.textTracks[0]; // there's only one!
var data = $(".subWrap");

var showInVideoClip = true;
var skipLinkshown = false;

//videoElement.muted = true;


textTrack.oncuechange = function() {
// "this" is a textTrack
    var cue = this.activeCues[0]; // assuming there is only one active cue
    if (!!cue) {
        cue = this.activeCues[0];
        showSubtitle(cue);

        cue.onexit = function() {
            console.log("onexit");
            removeSubtitle();
        };
    }

};
function showSubtitle(cue) {
    console.log('Showing "' + cue.id + '"...');

    if (cue.id === 'inVideoAd') {
        $('.subWrap').append('<div class="subtitle ' + cue.id + '"><span>close</span>' + cue.text + '</div>');

    } else if (cue.id === 'borderAd') {
        $('#advertWrap').append('<div class="externAd ' + cue.id + '">' + cue.text + '</div>');
    } else if (cue.id === 'inVideoClip' && showInVideoClip) {

        showInVideoClip = !showInVideoClip;

        var oldSrc = $('video > source').attr('src');
        var track = $('video > track');
        track.remove();

        $('video')[0].removeAttribute("controls");
        $('video')[0].pause();
        $('video > source').attr('src', cue.text);
        $('video')[0].load();
        $('video')[0].play();

        $('.subWrap').append('<div id="duration"> <div id="skipLink" style="display:none">Skip advertising?</div> <div id="timeInfo"></div> </div>');

        var currentTime = 0, duration = 0;
        function getDuration() {
            currentTime = (videoElement.currentTime).toFixed(0);

            duration = (videoElement.duration).toFixed(0);

            $('#timeInfo').html('<span>Ad</span> ' + currentTime + '/' + duration);

            if (currentTime > 5 && !skipLinkshown) {
                skipLinkshown = !skipLinkshown;
                $('#skipLink').show();
            }
        }

        setInterval(getDuration, 1000);

        $('#skipLink').click(function() {
            console.log('user skipped video ad');
            $('video')[0].currentTime = duration;
        });


        $('video')[0].addEventListener('ended', function() {
            console.log("ad clip finished");
            $('#duration').remove();

            // start the video

            $('video')[0].addEventListener('loadedmetadata', function() {
                this.currentTime = 0.1;
            }, false);

            //$('video').append(track);
            $('video > source').attr('src', oldSrc);
            $('video')[0].setAttribute("controls", "controls");
            $('video')[0].load();
        });

    } else {
        console.log("Unknown cue.id given in your .vtt file?");
    }

    $('.subtitle').find('span').click(function() {
        removeSubtitle();
        console.log("close clicked");
    });
}

function removeSubtitle() {
    $('.subtitle').fadeOut();
    $('.subtitle').remove();

    $('.externAd').fadeOut();
    $('.externAd').remove();
}

$(document).ready(function() {

});



