$(document).ready(init);

var player;

var bufferBar;
var scrubber;
var scrubberContainer;

var bufferBarWidth=400;

function init()
{
    if($('#video').length>0)
    {
        player = $("#video")[0];

        $("#playBtnOverlay").click(togglePlayHandler);
        $(".playButton").click(togglePlayHandler);
        $(".fullscrButton").click(toggleFullscreenHandler);

        bufferBar = $("#buffer");
        scrubber = $("#scrubber");
        scrubberContainer = $("#scrubber_container");
        bufferBarWidth = $(bufferBar).width();

        $(player).bind("timeupdate", timeUpdateHandler);
        player.addEventListener('paused',playerStatusChangedHandler);
        player.addEventListener('play',playerStatusChangedHandler);
        scrubberContainer.click(scrubberContainerClickHandler);

        $("#playBtnOverlay").css({ opacity: 0 });
        $("#videocontroller").hover(showPlayBtn, hidePlayBtn);
    }
}

function showPlayBtn(){
    $("#playBtnOverlay").animate({opacity:1});
}

function hidePlayBtn(){
    $("#playBtnOverlay").animate({opacity:0});
}

function showBufferProgress()
{
    $(bufferBar).empty();
    for(var i = 0; i < player.buffered.length; i++) {
        var startTime = player.buffered.start(i);
        var endTime = player.buffered.end(i);

        var startTimeRelative = startTime / player.duration;
        var endTimeRelative = endTime / player.duration;
        var left = startTimeRelative * bufferBarWidth;
        var width = endTimeRelative * bufferBarWidth - left;

        if(i==0) // fix voor safari
            $(bufferBar).append('<div style="left:' + left + 'px;width:' + width + 'px;"></div>');
    }
}

function scrubberContainerClickHandler(e)
{
    var parentOffset = $(this).offset();
    var relX = e.pageX - parentOffset.left;
    player.currentTime = ((relX)/$(scrubberContainer).width())*player.duration;
}

function timeUpdateHandler()
{
    currentTime = player.currentTime;
    totalTime = player.duration;
    perc = currentTime/totalTime;
    var xPos = parseInt(perc*($(scrubberContainer).width()-$(scrubber).width()),10);
    $(scrubber).css({width:$(scrubberContainer).width()*perc});
}

function togglePlayHandler()
{
    if (player.paused) {
        player.play();
    }
    else {
        player.pause();
    }
    playerStatusChangedHandler();
    return false;
}

function playerStatusChangedHandler()
{
    $(".playButton").addClass("pauseButton");

    if (player.paused)
    {
        $(".playButton").removeClass("pauseButton");
        $("#playBtnOverlay").fadeTo( 250, 1 );
        $("#videocontroller").hover(showControls, hideControls);
    }
    else
    {
        $("#playBtnOverlay").fadeTo( 250, 0 );
        $("#videocontroller").hover(showControls, hideControls);
    }
}

function toggleFullscreenHandler()
{
    player.play();
    player.webkitRequestFullScreen();
}

function showControls(){
    $("#bottomControls").fadeTo( 300, 1 );
}

function hideControls(){
    $("#bottomControls").fadeTo( 300, 0 );
}