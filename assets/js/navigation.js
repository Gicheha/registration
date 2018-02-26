$(document).ready(function()
{
    //on load
    $('.content').hide().fadeIn(1500);
    $('.boxout1 > h3').css('color','FF')
    
    //on clicking the log in button
    $('#log-in').click(function(){
        
        //fade out the main content+
        $('.content').fadeOut(3000);
        
        //chain 'em
        $('.sign-up').css("display","none");
        $('.log-in').css("display","block").hide().fadeIn(3000);
    });//end click
    
    $('#sign-up').click(function(){
        
        //fade out main content
        $('.content').fadeOut(3000);
        
        //chain 'em
        $('.log-in').css("display","none");
        $('.sign-up').css("display","block").hide().fadeIn(3000);
    });//end click
    
    
}); //end ready