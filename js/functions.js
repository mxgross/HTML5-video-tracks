
function debug(text) {
    console.log(text);
}

var videoElement = $("video")[0];
var textTracks = videoElement.textTracks; // one for each track element
var textTrack = textTracks[0]; // corresponds to the first track element
var kind = textTrack.kind; // e.g. "subtitles"
var mode = textTrack.mode; // e.g. "disabled", hidden" or "showing"
var cues = textTrack.cues;
var cue = cues[0]; // corresponds to the first cue in a track src file
var cueId = cue.id; // cue.id corresponds to the cue id set in the WebVTT file
var cueText = cue.text; // "The Web is always changing", for example (or some JSON!)

// Loop each textTrack e.g. subtitle de, subtitle es, ...´
for (i = 0; i < textTracks.length; i++) {
    debug("TRACKS: ");
    debug(textTracks[i]);

    debug("CUES: ");
    if (textTracks[i].cues !== null) {
        for (var j = 0; j < textTracks[i].cues.length; j++) {
            
            // bind eventListener to each cue
            cue = textTracks[i].cues[j];
            debug(cue);
        }
    }

    debug('___________________________');
}
debug("There were " + i + " tracks found.");


// Functions called by the EventListener
function onenter() {
    debug("ENTERED: '" + cue.id + "' : " + cue.text);
    $('.subWrap').append('<div class="subtitle" style="display: none">' + cue.text + '</div>');
    $('.subtitle').fadeIn('slow');
}
function onexit() {
    debug("EXIT: " + cue.id);
    $('.subtitle').fadeOut('slow');
    $('.subtitle').remove();
}

// EvetnListener
cue.onenter = function() {
    onenter();
};
cue.onexit = function() {
    onexit();
};






