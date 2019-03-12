var  t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function base64_decode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}e+="";do{s=t.indexOf(e.charAt(l++));o=t.indexOf(e.charAt(l++));u=t.indexOf(e.charAt(l++));a=t.indexOf(e.charAt(l++));f=s<<18|o<<12|u<<6|a;n=f>>16&255;r=f>>8&255;i=f&255;if(u==64){p[c++]=String.fromCharCode(n)}else if(a==64){p[c++]=String.fromCharCode(n,r)}else{p[c++]=String.fromCharCode(n,r,i)}}while(l<e.length);h=p.join("");return h.replace(/\0+$/,"")}

function base64_encode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}do{n=e.charCodeAt(l++);r=e.charCodeAt(l++);i=e.charCodeAt(l++);f=n<<16|r<<8|i;s=f>>18&63;o=f>>12&63;u=f>>6&63;a=f&63;p[c++]=t.charAt(s)+t.charAt(o)+t.charAt(u)+t.charAt(a)}while(l<e.length);h=p.join("");var d=e.length%3;return(d?h.slice(0,d-3):h)+"===".slice(d||3)}

