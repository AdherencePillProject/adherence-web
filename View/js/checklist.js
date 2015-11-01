/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on("click", ".word", function(){
    var list = $(this).parent().siblings();
    if($(list).css('opacity') == '1') {
        $(list).animate({opacity:0}, 800, function(){$(this).toggle(800);});
    }
    else {
        $(list).toggle(800).animate({opacity:1});
    }
});