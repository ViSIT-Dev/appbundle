"use strict";

const IDLE_TIMEOUT = 600;

let idle = 0;

setInterval(function () {
    if(idle++ === IDLE_TIMEOUT && ! $("#startModal").hasClass("show")){
        $('#startModal').modal('show');
    }
}, 1000);

function registerInput(event){
    idle = 0;
}

try{
    window.addEventListener('click', registerInput);
}catch (e) {}

try{
    document.getElementsByClassName("content-holder")[0].addEventListener('scroll', registerInput);
}catch (e) {}

try{
    document.getElementsByClassName("scrollWrapper")[0].addEventListener('scroll', registerInput);
}catch (e) {}

try{
    document.getElementById("scrolllist").addEventListener('scroll', registerInput);
}catch (e) {}

try{
    let items = document.getElementsByClassName("galery-content-layout");
    for(let i = 0; i < items.length; i++){
        console.log(items[i]);
        items[i].addEventListener('scroll', registerInput);
    }
}catch (e) {}

// document.addEventListener("DOMContentLoaded", function(event) {
//     try{
//         $.ajax({
//             url: "/fileadmin/reload",
//         }).done(function() {
//             console.log("reload");
//             location.reload();
//         });
//     }catch(e){}
// });
