var  t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function base64_decode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}e+="";do{s=t.indexOf(e.charAt(l++));o=t.indexOf(e.charAt(l++));u=t.indexOf(e.charAt(l++));a=t.indexOf(e.charAt(l++));f=s<<18|o<<12|u<<6|a;n=f>>16&255;r=f>>8&255;i=f&255;if(u==64){p[c++]=String.fromCharCode(n)}else if(a==64){p[c++]=String.fromCharCode(n,r)}else{p[c++]=String.fromCharCode(n,r,i)}}while(l<e.length);h=p.join("");return h.replace(/\0+$/,"")}

function base64_encode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}do{n=e.charCodeAt(l++);r=e.charCodeAt(l++);i=e.charCodeAt(l++);f=n<<16|r<<8|i;s=f>>18&63;o=f>>12&63;u=f>>6&63;a=f&63;p[c++]=t.charAt(s)+t.charAt(o)+t.charAt(u)+t.charAt(a)}while(l<e.length);h=p.join("");var d=e.length%3;return(d?h.slice(0,d-3):h)+"===".slice(d||3)}

window.threeJsScenes = [];
//init 3d
$("document").ready(function () {

    $(".render3d-container").each(function (index, elm) {
        let $elm = $(elm);

        let obj = "/" + $elm.data("object");
        let objFile = obj.replace(/^.*(\\|\/|\:)/, '');
        let objPath = obj.substring(0, obj.length - objFile.length);

        let mtl = "/" + $elm.data("material");
        let mtlFile = mtl.replace(/^.*(\\|\/|\:)/, '');
        let mtlPath = mtl.substring(0, mtl.length - mtlFile.length);

        let text = "/" + $elm.data("texture");
        let textFile = text.replace(/^.*(\\|\/|\:)/, '');
        let textPath = text.substring(0, text.length - textFile.length);

        let height = $(elm).parent().parent().innerHeight();
        let width =  $(elm).parent().parent().innerWidth();

        // new scene
        let scene = new THREE.Scene();

        // create the renderer and append to DOM
        let renderer = new THREE.WebGLRenderer();
        renderer.setSize( width, height );
        renderer.setClearColor( 0xffcc00, 0.8);
        $(elm).html("");
        $(elm).append( renderer.domElement );

        // define camera position
        let camera = new THREE.PerspectiveCamera( 75, width/height, 0.1, 1000 );
        camera.position.z = 200;

        // add controls
        let controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.25;
        controls.enableZoom = true;

        // add some light
        scene.add( new THREE.AmbientLight( 0xFFFFFF, 1.5 ) );

        // load material
        let mtlLoader = new THREE.MTLLoader();
        mtlLoader.setTexturePath(textPath);
        mtlLoader.setPath(mtlPath);
        mtlLoader.load(mtlFile, function (materials) {

            materials.preload();

            // load Object
            let objLoader = new THREE.OBJLoader();
            objLoader.setMaterials(materials);
            objLoader.setPath(objPath);
            objLoader.load(objFile, function (object) {

                // fits object within a bounding box of 100 max (Change to change object size)
                let objBox = new THREE.Box3().setFromObject(object);
                ratio = 100 / Math.max(objBox.getSize().x, objBox.getSize().y, objBox.getSize().z);
                object.scale.x = object.scale.y = object.scale.z = ratio;

                // add Object with material to scene
                scene.add(object);

            });

        });

        // animation function
        let animate = function () {
            controls.update();
            requestAnimationFrame( animate );
            renderer.render(scene, camera);
        };

        // start animation
        animate();
    });

});