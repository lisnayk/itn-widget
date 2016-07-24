
function animateLeft(obj, from, to, speed){
   if(from >= to){         
       //obj.style.visibility = 'hidden';
        obj.style.right = to + "px";
       return;  
   }
   else {
   	   obj.style.visibility = 'visible';
       var box = obj;
       box.style.right = from + "px";
       setTimeout(function(){
           animateLeft(obj, from + speed, to, speed);
       }, 0) 
   }
}
function animateRight(obj, from, to, speed){
   if(from <= to){         
       //obj.style.visibility = 'hidden';
       obj.style.right = to + "px";
       return;  
   }
   else {
    	 obj.style.visibility = 'visible';
       var box = obj;
       box.style.right = from + "px";
       setTimeout(function(){
           animateRight(obj, from - speed, to,speed);
       }, 0) 
   }
}

window.onload = function() {
    var holder = document.createElement("div");
    var iframe = document.createElement('iframe');
    var btn = document.createElement("div");
    var parent = document.createElement("div");
    
    holder.style.width = "500px";
    holder.style.height = "550px";
    holder.style.position = "absolute";
    holder.style.right = "0px";
    //holder.style.border = "1px solid #ccc";
    holder.style.margin = "0px";
    holder.style.bottom = "0px";
    holder.style.overflow = "hidden";
    
    
    
    btn.style.position = "absolute";
    btn.innerHTML ="&#215;"
    //btn.style.width = "20px";
    //btn.style.height = "20px";
    btn.style.top = "-25px";
    btn.style.left = "-25px";
    btn.style.cursor = "pointer";
   // btn.style.border ="1px solid #ccc";
    //btn.style.borderRadius  = "11px";
         btn.style.fontSize = "25px";
         btn.onclick=function(){
            var w = iwParent.offsetWidth + parseInt(iwParent.style.marginLeft.replace("px","")) + parseInt(iwParent.style.marginRight.replace("px",""));
            var r= iwParent.style.right;
            console.log(w);
            console.log(r);
            console.log(iwParent.style.right);
            if (iwParent.style.right == '0px'){
                animateRight(iwParent, 0, -w, 5);
                btn.innerHTML ="&#171;";
              
            } else {
                
                animateLeft(iwParent, -w, 0, 5);
                
                btn.innerHTML ="&#215;";
               
            }
             console.log(iwParent.style.right);
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
    holder.appendChild(parent);
    document.body.appendChild(holder);
};