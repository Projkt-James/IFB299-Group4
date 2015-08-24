/*
*
*   NAME: jQuery/Javascript Animation
*   AUTHOR: James Hanford
*   CREATED: 20/08/2015
*   VERSION: 1.0.0
*
*/

/***************************
ON DOC READY ~ START
***************************/
$(document).ready(function () {
    
    window.setInterval(adjFade, 10000);
    
});
/***************************
ON DOC READY ~ END
***************************/

function adjFade(){
   
    $('.title').removeClass('fadeIn');
    $('.title').addClass('fadeOut');
    setTimeout(function() {
        $('.title').removeClass('fadeOut');
        $('.title').addClass('fadeIn');
    }, 4000);
}