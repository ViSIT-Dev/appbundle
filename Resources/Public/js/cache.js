var SKIP_URLS = ["http://leafletjs.com/"];
var CACHE_NAME = "static-visit";
var filesToCache = [window.location.pathname+window.location.search];


function addToCacheList(elements, attr) {
    for (let i = 0; i < elements.length; i++) {
        let url = elements[i][attr];
        if (url && url.length > 0 && url.startsWith("http") && SKIP_URLS.indexOf(url) == -1) {
            filesToCache.push(url);
        }
    }
}

addToCacheList(document.getElementsByTagName("link"), "href");
addToCacheList(document.getElementsByTagName("script"), "href");
addToCacheList(document.getElementsByTagName("img"), "src");


self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function(cache) {

            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request).catch(function() {
            return caches.match(event.request);
        })
    );
});
