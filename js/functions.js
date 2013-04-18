var videoElement = document.querySelector("video");
var textTrack = videoElement.textTracks[0]; // there's only one!

var data = $(".subWrap");
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
    $('.subWrap').append('<div class="subtitle ' + cue.id + '">' + cue.text + '</div>');
}

function removeSubtitle() {
    $('.subtitle').remove();
}