/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//GLOBALS///
var commercialIsNowPlaying = false;
var skipLinkshown = false;
///////////

var videoElement = $("video");
var video = videoElement[0];

var textTrack = video.textTracks[0];

textTrack.oncuechange = function() {
    console.log("change in cue");
// "this" is a textTrack
    var cue = this.activeCues[0]; // assuming there is only one active cue
    if (!!cue) {
        cue = this.activeCues[0];
        //console.log(cue.id);

        // witch kind of ad is given?
        switch (cue.id) {
            case 'inVideoCommercial':
                showInVideoCommercial(cue);
                break;

            case 'inVideoAd':
                showInVideoAd();
                break;

            case 'borderAd':
                showBorderAd();
                break;
        }

        cue.onexit = function() {
            console.log("onexit");
        };
    }
};


function showInVideoCommercial(cue) {
    console.log("showing InVideoCommercial...");
    commercialIsNowPlaying = true;

    //stop main video
    video.pause();

    // save the main video src
    var mainSrc = videoElement.find('source').attr('src');
    console.log(mainSrc);

    //change video source
    videoElement.find('source').attr('src', cue.text);

    // save the main video track
    var mainTrack = videoElement.find('track');

    // delete the track vom the video element
    videoElement.find('track').remove();

    // hide video controls during commercial to avoid skipping
    console.log("remove controls");
    video.removeAttribute("controls");

    // start commercial
    video.load();
    video.play();

    // show the duration of the commercial and add a 'skip link' after x seconds
    $('.inVideoAdWrap').append('<div class="skipCommercial"> <div id="skipLink">Skip commercial</div> <div id="timeInfo"></div> </div>');

    var currentTime = 0, duration = 0;
    var secondsBeforSkipLinkAppears = 4;
    function getDuration() {
        currentTime = (video.currentTime).toFixed(0);

        duration = (video.duration).toFixed(0);

        $('#timeInfo').html('<span>Ad</span> ' + currentTime + '/' + duration);

        if (currentTime > secondsBeforSkipLinkAppears && !skipLinkshown) {
            skipLinkshown = !skipLinkshown;
            $('#skipLink').show();
        }
    }
    setInterval(getDuration, 1000);

    $('#skipLink').click(function() {
        console.log('user skipped video ad');
        video.currentTime = duration;
    });

    //start main video if the commercial is over

    video.addEventListener('ended', function() {
        if (commercialIsNowPlaying) {
            console.log("commercial is stopping...");
            $('.skipCommercial').remove();

            // time to start the main video
            console.log("starting main video...");
            videoElement.find('source').attr('src', mainSrc);

            video.addEventListener('loadedmetadata', function() {
                this.currentTime = 0.5;
            }, false);

            video.load();

            // display controls
            video.setAttribute("controls", "controls");
            video.play();

            videoElement.append('<track label="German subtitles" mode="showing" kind="subtitles" srclang="de" src="track/textAd.vtt" default />');
        }
    });

}

function showInVideoAd() {
    console.log("showing InVideoAds...");
}

function showBorderAd() {
    console.log("showing borderAds...");
}