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
    
    //Navbar Toggle 
    $('.Nav-Toggle').click(function(){   
        
        if($('nav').hasClass('active')){
            $('.TopBar').css("width", "100%");         
        }else{
            var containerWidth = $(window).width() - $('nav').width();   
            $('.TopBar').css("width", containerWidth);     
        }
        
        $('.Page-Container').toggleClass('resize');
        $('nav').toggleClass('active');  
    });
         
    
    $('.Library-Upload').click(function(){
        
        if($('.upload-input').hasClass('upload-input-hidden')){
            $('.upload-input').removeClass('upload-input-hidden');
            setTimeout(function() {
                $('.upload-input').children().css("display","block");
            }, 800);
        }else{
            var Files = $('.tested')[0].files;
            
            if(Files.length > 0){
                $('.Upload-Trigger').trigger( "click" );
            }else{
                window.alert("No files selected");    
            }
        }
    });
    
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

