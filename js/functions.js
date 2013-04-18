var videoElement = document.querySelector("video");
var textTrack = videoElement.textTracks[0]; // there's only one!
var data = $(".subWrap");


videoElement.muted = true;


textTrack.oncuechange = function() {
// "this" is a textTrack
    var cue = this.activeCues[0]; // assuming there is only one active cue
    if (!!cue) {
        cue = this.activeCues[0];
        showSubtitle(cue);
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
    }

    $('.subtitle').find('span').click(function() {
        $('.subtitle').fadeOut();
        console.log("close clicked");
    });
}

function removeSubtitle() {
    $('.subtitle').remove();
}

$(document).ready(function() {


});

