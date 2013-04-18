
function debug(text) {
    console.log(text);
}

$(window).load(function() {

    var cues = $("video")[0].textTracks[0].cues;
    var cue = cues[0];
    var i;

    for (i = 0; i < cues.length; i++) {
        cue = $("video")[0].textTracks[0].cues[i];
        console.log(cue);
    }
    debug("There are " + i + " cues found.");

//////////////////////////
   var cue = $("video")[0].textTracks[0].cues[2];
/////////////////////////

    cue.onenter = function() {
        // do something
        debug("ENTERED: '" + cue.id + "' : " + cue.text);
        $('.subWrap').append('<div class="subtitle">' + cue.text + '</div>');
    };

    cue.onexit = function() {
        debug("EXIT: " + cue.id);
        $('.subWrap').find('.subtitle').remove();
    };




});


