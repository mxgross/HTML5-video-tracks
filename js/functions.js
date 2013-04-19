var videoElement = document.querySelector("video");
var textTrack = videoElement.textTracks[0]; // there's only one!
var data = $(".subWrap");

var showInVideoClip = true;

videoElement.muted = true;


textTrack.oncuechange = function() {
// "this" is a textTrack
    var cue = this.activeCues[0]; // assuming there is only one active cue
    if (!!cue) {
        cue = this.activeCues[0];
        showSubtitle(cue);
        cue.onenter = function() {
            //console.log("onenter");
        };

        cue.onenter = function() {
            console.log("onenter");
        };

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

    } else if (cue.id === 'externAd') {
        $('#advertWrap').append('<div class="externAd ' + cue.id + '">' + cue.text + '</div>');
    } else if (cue.id === 'inVideoClip' && showInVideoClip) {
        
        showInVideoClip = !showInVideoClip;
        
        var oldSrc = $('video > source').attr('src');
        var track = $('video > track');
        track.remove();

        $('video')[0].pause();
        $('video > source').attr('src', cue.text); 
        $('video')[0].load();
        $('video')[0].play();
        $('video')[0].addEventListener('ended', function() {
            console.log("ad clip finished");
            // start the video
            $('video > source').attr('src', oldSrc);
            $('video').append(track);
            $('video')[0].currentTime = 1;
            $('video')[0].setAttribute("controls","controls");
            $('video')[0].load();
            $('video')[0].play();
        });

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

