/*
*
*   NAME: jQuery/Javascript Animation
*   AUTHOR: James Hanford
*   CREATED: 20/08/2015
*   VERSION: 2.0.0
*
*/

/***************************
ON DOC READY ~ START
***************************/
$(document).ready(function () {
    
    //------------------------------
    // SEARCH 
    //------------------------------
    
    // Sets search from address bar get
    QuerySearch();
    
    // Live filtering of items using search bar 
    LiveSearch();
    
    // Displays search bar when toggled
    $('.Search-Trigger').click(function(){
        $('.Library-Search').addClass('active');
    });
    
    //------------------------------
    // NAV BAR
    //------------------------------
    
    // Navbar Toggle 
    $('.Nav-Toggle').click(function(){   
        $('.Page-Container').toggleClass('resize');
        $('nav').toggleClass('active');  
    });
         
    //------------------------------
    // MEDIA UPLOAD
    //------------------------------
    
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
    
    
    //------------------------------
    // MEDIA PREVIEW
    //------------------------------
    
    //Opens Media Item Preview on click of Item Thumbnail
    $('.Item-Thumb').click(function(){
        var path = $(this).parent().children(".Item-View-Container");
        $(path).addClass('active');
    });
    
    //Closes Media Item Preview 
    $('.Item-View-Title-Top i').click(function(){
        var path = $(this).parentsUntil(".Library-Item");
        $(path).addClass('hidden');
        $(path).removeClass('active');
        setTimeout(function(){ $(path).removeClass('hidden'); }, 1000);
    });
    
    //------------------------------
    // MEDIA DELETE
    //------------------------------
    
    //Prompts and performs Media Item Delete
    $('.Item-View-Bottom-Delete').click(function(){
        var path = $(this).parentsUntil(".Library-Item");
        var path2 = $(path).parent();
        var x = $(this).attr('id');
        alert(x);
        
        //Prompt to ensure user wishes to delete item
        var result = confirm("Did you want to Delete?");
        
        //If users agrees to prompt message
        if(result == true){
            
            //Concatenate the data to array:
            var val = {xval: x};
            $.ajax({
                //the path to the php file that handles the data
                url: "../includes/delete_item.php",
                type: "POST",
                dataType: 'json',
                data: val,

                success: function(data) {
                    
                    //Success Status 
                    if(data.status == "Success"){
                        $(path).remove();
                        $(path2).remove();
                        
                    //Failure Status
                    }else if(data.status == "Failure"){
                        alert(data.message);
                    }
                },

                error: function(data) {
                    alert("Something Went Wrong :( ");
                }
            });
        }
    });
    
});

/***************************
ON DOC READY ~ END
***************************/

function QuerySearch(){
    var getQuery = $(document).getUrlParam("q");
    
    if(getQuery){
        var filter = getQuery;
        $('.Library-Search').addClass('active');
        $('.Library-Search input').val(getQuery);
        
        // Loop through the comment list
        $(".Library-Container .Library-Item").each(function(){
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
            }
        });
    }      
}

function LiveSearch(){
    $("#filter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
    
        // Loop through the comment list
        $(".Library-Container .Library-Item").each(function(){
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
            }
        });
    });
}   