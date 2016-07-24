window.onload = function() {
    var iframe = document.createElement('iframe');
    var btn = document.createElement("div");
    var parent = document.createElement("div");
    
    btn.style.position = "absolute";
    btn.innerHTML ="&#215;"
    //btn.style.width = "20px";
    //btn.style.height = "20px";
    btn.style.top = "-25px";
    btn.style.left = "-25px";
   // btn.style.border ="1px solid #ccc";
    //btn.style.borderRadius  = "11px";
         btn.style.fontSize = "25px";
         btn.onclick=function(){
         console.log(iwParent.style.width );
            if (iwParent.style.width == "0px"){
                iwParent.style.width ="400px";
                iwParent.style.border = "1px solid #ccc";
            } else {
                iwParent.style.width ="0px";
                iwParent.style.border = "0px";
            }
         };
    parent.id = "iwParent";
    parent.style.width = "400px";
    parent.style.height = "500px";
    parent.style.position = "absolute";
    
    parent.style.right = "0px";
    parent.style.border = "1px solid #ccc";
    parent.style.margin = "5px";
    parent.style.bottom = "0px";

    iframe.src = "http://dist/";
    iframe.frameborder="0";
    iframe.style.width = "100%";
    iframe.style.height = "100%";
    iframe.style.border = "0px";
    
    parent.appendChild(btn);
    parent.appendChild(iframe);
    document.body.appendChild(parent);
};