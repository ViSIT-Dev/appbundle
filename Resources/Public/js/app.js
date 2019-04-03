var  t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function base64_decode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}e+="";do{s=t.indexOf(e.charAt(l++));o=t.indexOf(e.charAt(l++));u=t.indexOf(e.charAt(l++));a=t.indexOf(e.charAt(l++));f=s<<18|o<<12|u<<6|a;n=f>>16&255;r=f>>8&255;i=f&255;if(u==64){p[c++]=String.fromCharCode(n)}else if(a==64){p[c++]=String.fromCharCode(n,r)}else{p[c++]=String.fromCharCode(n,r,i)}}while(l<e.length);h=p.join("");return h.replace(/\0+$/,"")}

function base64_encode(e){var n,r,i,s,o,u,a,f,l=0,c=0,h="",p=[];if(!e){return e}do{n=e.charCodeAt(l++);r=e.charCodeAt(l++);i=e.charCodeAt(l++);f=n<<16|r<<8|i;s=f>>18&63;o=f>>12&63;u=f>>6&63;a=f&63;p[c++]=t.charAt(s)+t.charAt(o)+t.charAt(u)+t.charAt(a)}while(l<e.length);h=p.join("");var d=e.length%3;return(d?h.slice(0,d-3):h)+"===".slice(d||3)}


//init 3d
$(".render3d-container").each(function (index, elm) {
    let $elm = $(elm);
    console.log($elm.data("object"));
    console.log($elm.data("material"));
    console.log($elm.data("texture"));
});

// var camera, scene, renderer,
//     geometry, material, mesh, light1, stats;
//
// // onclick magic
// //    var mouse = new THREE.Vector2(), INTERSECTED;
// //    var raycaster = new THREE.Raycaster();
//
// function init() {
//
//     scene = new THREE.Scene();
// //        scene.background = new THREE.Color(0xffffff);
//     //scene.fog = new THREE.Fog(0x72645b, 2, 55);
//     var contentDom = document.getElementsByClassName('render3d-container')[0];
//
//     var texloader = new THREE.TextureLoader();
//     var color = texloader.load("/typo3conf/ext/visit_tablets/Resources/Public/SampleData/color.jpg");
//     var tex = texloader.load("/typo3conf/ext/visit_tablets/Resources/Public/SampleData/texture_map.jpg");
//
// //        var boxHeight = contentDom.clientHeight;
// //        var boxWidth = contentDom.clientWidth;
//     var boxHeight = 290;
//     var boxWidth = 290;
//
//     // --------------- JSONLoader
//     var loader = new THREE.JSONLoader();
//     // load a resource
//     loader.load(
//         '/typo3conf/ext/visit_tablets/Resources/Public/SampleData/granate.json',
//         function (geometry, materials) {
//             geometry.computeBoundingBox();
//
//             maxLenght = Math.max(geometry.boundingBox.max.x - geometry.boundingBox.min.x, geometry.boundingBox.max.y - geometry.boundingBox.min.y);
//             maxLenght = Math.max(maxLenght, geometry.boundingBox.max.z - geometry.boundingBox.min.z);
//             scale = 25 / maxLenght;
//
//             var material = materials[ 0 ];
//             material.shininess = 0;
//             console.log(material);
//
//             var mesh = new THREE.Mesh(geometry, material);
//             mesh.scale.set(scale, scale, scale);
// //                    mesh.callback = function () {
// //                        alert("doper monkey click");
// //                    }
// //                    assignUVs(mesh);
//             scene.add(mesh);
//         }
//     );
//
//     // --------------- Camera and Lignting
//     camera = new THREE.PerspectiveCamera(75, boxWidth / boxHeight, 10, 1000);
//     cameraTarget = new THREE.Vector3(0, 0, 0);
//
//     var light_0 = new THREE.DirectionalLight(0xffffff, 0.5);
//     light_0.position.set(150, 100, 100);
//     light_0.position.normalize();
//     camera.add(light_0);
//     var light_1 = new THREE.DirectionalLight(0xffffff, 0.5);
//     light_1.position.set(-150, 100, 100);
//     light_1.position.normalize();
//     camera.add(light_1);
//     var light_2 = new THREE.DirectionalLight(0xffffff, 0.5);
//     light_2.position.set(0, -100, -100);
//     light_2.position.normalize();
//     camera.add(light_2);
//     scene.add(camera);
//
//     camera.position.z = 30;
//     camera.position.y = -30;
//     camera.lookAt(cameraTarget);
//     //---------------*/
//
//     // --------------- Renderer
//     renderer = new THREE.WebGLRenderer({
//         antialias: true,
//         alpha: true
//     }); //new THREE.CanvasRenderer();
//     renderer.setSize(boxWidth, boxHeight);
//     renderer.setClearColor(0x000000, 0); // the default
//     contentDom.appendChild(renderer.domElement);
//     //---------------*/
//
//     // --------------- Controlls
//     var controls = new THREE.OrbitControls(camera, renderer.domElement);
//     //var controls = new THREE.OrbitControls(mesh, renderer.domElement);
//     controls.minDistance = 23;
//     controls.maxDistance = 30;
//     controls.target.set(0, 0, 0);
//     controls.update();
//     //---------------*/
//
//     // Stats
// //        stats = new Stats();
// //        //                stats.showPanel(1); // 0: fps, 1: ms, 2: mb, 3+: custom
// //        stats.domElement.style.position = 'absolute';
// //        stats.domElement.style.bottom = '0px';
// //        stats.domElement.style.right = '0px';
// //        contentDom.appendChild(stats.domElement);
//     //---------------*/
// }
//
// function animate() {
//
//     // note: three.js includes requestAnimationFrame shim
//     requestAnimationFrame(animate);
// //            stats.update();
//     render();
//
// }
//
// function render() {
// //        pointclouds = null;
// //        raycaster.setFromCamera(mouse, camera);
// //        var intersections = raycaster.intersectObjects(pointclouds);
// //        intersection = (intersections.length) > 0 ? intersections[ 0 ] : null;
//
//     renderer.render(scene, camera);
// }
//
// function assignUVs(geometry) {
//     geometry.faceVertexUvs[0] = [];
//     geometry.faces.forEach(function (face) {
//
//         var components = ['x', 'y', 'z'].sort(function (a, b) {
//             return Math.abs(face.normal[a]) > Math.abs(face.normal[b]);
//         });
//
//         var v1 = geometry.vertices[face.a];
//         var v2 = geometry.vertices[face.b];
//         var v3 = geometry.vertices[face.c];
//
//         geometry.faceVertexUvs[0].push([
//             new THREE.Vector2(v1[components[0]], v1[components[1]]),
//             new THREE.Vector2(v2[components[0]], v2[components[1]]),
//             new THREE.Vector2(v3[components[0]], v3[components[1]])
//         ]);
//
//     });
//
//     geometry.uvsNeedUpdate = true;
// }
//
// var mouseDown = false,
//     mouseX = 0,
//     mouseY = 0;
//
// function onMouseMove(evt) {
//     if (!mouseDown) {
//         return;
//     }
//
//     evt.preventDefault();
//
//     var deltaX = evt.clientX - mouseX,
//         deltaY = evt.clientY - mouseY;
//     mouseX = evt.clientX;
//     mouseY = evt.clientY;
//     rotateScene(deltaX, deltaY);
// }
//
// function onMouseDown(evt) {
//     evt.preventDefault();
//
//     mouseDown = true;
//     mouseX = evt.clientX;
//     mouseY = evt.clientY;
// }
//
// function onMouseUp(evt) {
//     evt.preventDefault();
//
//     mouseDown = false;
// }
//
// function addMouseHandler(canvas) {
//     canvas.addEventListener('mousemove', function (e) {
//         onMouseMove(e);
//     }, false);
//     canvas.addEventListener('mousedown', function (e) {
//         onMouseDown(e);
//     }, false);
//     canvas.addEventListener('mouseup', function (e) {
//         onMouseUp(e);
//     }, false);
// }
//
// function rotateScene(deltaX, deltaY) {
//     mesh.rotation.x += deltaX / 100;
//     mesh.rotation.y += deltaY / 100;
// }
//
//
// function resize() {
// //        var h = window.innerHeight
// //                - 135
// //                - document.getElementsByTagName("header")[0].style.height
// //                - document.getElementsByTagName("footer")[0].style.height;
// //        console.log(h);
// //
// //        Array.prototype.forEach.call(document.getElementsByClassName("force-full-height"), function (el) {
// //            el.style.height = h + "px";
// //        });
//
// }
//
//
// window.onload = function () {
//     console.log("init 3d");
//     resize();
//     init();
//     animate();
// };
