var  t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function base64_decode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}e+="";do{s=t.indexOf(e.charAt(l++));o=t.indexOf(e.charAt(l++));u=t.indexOf(e.charAt(l++));a=t.indexOf(e.charAt(l++));f=s<<18|o<<12|u<<6|a;n=f>>16&255;r=f>>8&255;i=f&255;if(u==64){p[c++]=String.fromCharCode(n)}else if(a==64){p[c++]=String.fromCharCode(n,r)}else{p[c++]=String.fromCharCode(n,r,i)}}while(l<e.length);h=p.join("");return h.replace(/\0+$/,"")}

function base64_encode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}do{n=e.charCodeAt(l++);r=e.charCodeAt(l++);i=e.charCodeAt(l++);f=n<<16|r<<8|i;s=f>>18&63;o=f>>12&63;u=f>>6&63;a=f&63;p[c++]=t.charAt(s)+t.charAt(o)+t.charAt(u)+t.charAt(a)}while(l<e.length);h=p.join("");var d=e.length%3;return(d?h.slice(0,d-3):h)+"===".slice(d||3)}

window.threeJsScenes = [];
//init 3d
$("document").ready(function () {

    // readmore
    AddReadMore();

    // if not all languages active initialization of viewport hight is 0
    $("body").addClass("lang-de");
    $("body").addClass("lang-en");

    $(".render3d-container").each(function (index, elm) {

        let $elm = $(elm);

        let newScene = new Object();

        newScene.elm = $elm;

        newScene.obj = ("/" + $elm.data("object")).replace("//", "/");
        newScene.objFile = newScene.obj.replace(/^.*(\\|\/|\:)/, '');
        newScene.objPath = newScene.obj.substring(0, newScene.obj.length - newScene.objFile.length);

        newScene.mtl = ("/" + $elm.data("material")).replace("//", "/");
        newScene.mtlFile = newScene.mtl.replace(/^.*(\\|\/|\:)/, '');
        newScene.mtlPath = newScene.mtl.substring(0, newScene.mtl.length - newScene.mtlFile.length);

        newScene.text = ("/" + $elm.data("texture")).replace("//", "/");
        newScene.textFile = newScene.text.replace(/^.*(\\|\/|\:)/, '');
        newScene.textPath = newScene.text.substring(0, newScene.text.length - newScene.textFile.length);

        newScene.height = Math.max($elm.parent().parent().parent().innerHeight(), 230);
        newScene.width =  Math.max($elm.parent().parent().parent().innerWidth(), 230);

        console.log([
            newScene.obj,
            newScene.mtl,
            newScene.text,
            newScene.height,
            newScene.width
        ]);

        // align the viewbox vertically
        $elm.parent().parent().addClass("valign");
        $elm.parent().addClass("valign");
        $elm.parent().css("margin", "0");

        // new scene
        newScene.scene = new THREE.Scene();

        // create the renderer and append to DOM
        newScene.renderer = new THREE.WebGLRenderer({ alpha: true });
        newScene.renderer.setSize( newScene.width, newScene.height );
        newScene.renderer.setClearColor( 0xffcc00, 0);
        $elm.html("");
        $elm.append( newScene.renderer.domElement );

        // define camera position
        newScene.camera = new THREE.PerspectiveCamera( 75, newScene.width / newScene.height, 0.1, 1000 );
        newScene.camera.position.z = 200;

        // add controls
        newScene.controls = new THREE.OrbitControls(newScene.camera, newScene.renderer.domElement);
        newScene.controls.enableDamping = true;
        newScene.controls.dampingFactor = 0.75;
        newScene.controls.enableZoom = true;

        // add some light
        newScene.scene.add( new THREE.AmbientLight( 0xFFFFFF, 1.5 ) );

        // load material
        let mtlLoader = new THREE.MTLLoader();
        mtlLoader.setTexturePath(newScene.textPath);
        mtlLoader.setPath(newScene.mtlPath);
        mtlLoader.load(newScene.mtlFile, function (materials) {

            materials.preload();

            // load Object
            let objLoader = new THREE.OBJLoader();
            objLoader.setMaterials(materials);
            objLoader.setPath(newScene.objPath);
            objLoader.load(newScene.objFile, function (object) {

                // fits object within a bounding box of 100 max (Change to change object size)
                let objBox = new THREE.Box3().setFromObject(object);
                let ratio = 100 / Math.max(objBox.getSize().x, objBox.getSize().y, objBox.getSize().z);
                object.scale.x = object.scale.y = object.scale.z = ratio;

                // add Object with material to scene
                newScene.meshObject = object;
                newScene.scene.add(object);
                console.log(newScene);

                window.threeJsScenes.push(newScene);

            });

        });

    });

    // set default language
    setTimeout(function (){
        $("body").removeClass("lang-en");
    }, 1000);


    // animation function
    let animate = function () {
        window.threeJsScenes.forEach(function (el) {
            el.controls.update();
            el.renderer.render(el.scene, el.camera);
        });
        requestAnimationFrame( animate );
    };

    // start animation
    animate();

    // read more
    function AddReadMore() {
        // basic settings
        var carLmt = 1000;
        var readMoreTxt = "Mehr lesen";
        var readLessTxt = "Weniger";
        
        $(".addReadMore").each(function() {
            if ($(this).find(".firstSec").length)
                return;
     
            var allstr = $(this).text();
            if (allstr.length > carLmt) {
                var firstSet = allstr.substring(0, carLmt);
                var secdHalf = allstr.substring(carLmt, allstr.length);
                var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'></br></br><i class='mdi mdi-plus-circle'></i>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'></br></br><i class='mdi mdi-minus-circle'></i>" + readLessTxt + "</span>";
                $(this).html(strtoadd);
            }
     
        });
        //Read More and Read Less Click Event binding
        $(document).on("click", ".readMore,.readLess", function() {
            $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
        });
    }

    //-----------------------------------------------------------------------------DEV

});