// This is the service worker with the Cache-first network

const CACHE = "StaticVisit";
const precacheFiles = ["/fileadmin/user_upload/scope/deutsch/Kufstein.webm", "/fileadmin/user_upload/scope/englisch/Kufstein_EN.webm", "/fileadmin/user_upload/scope/deutsch/Innsbruck.webm", "/fileadmin/user_upload/scope/englisch/Innsbruck_EN.webm", "/fileadmin/user_upload/scope/deutsch/Hall.webm", "/fileadmin/user_upload/scope/englisch/Hall_EN.webm", "/fileadmin/user_upload/scope/deutsch/Schwaz.webm", "/fileadmin/user_upload/scope/englisch/Schwaz_EN.webm", "/fileadmin/user_upload/scope/deutsch/Rattenberg.webm", "/fileadmin/user_upload/scope/englisch/Rattenberg_EN.webm", "/fileadmin/user_upload/scope/deutsch/Rosenheim.webm", "/fileadmin/user_upload/scope/englisch/Rosenheim_EN.webm", "/fileadmin/user_upload/scope/deutsch/Wasserburg.webm", "/fileadmin/user_upload/scope/englisch/Wasserburg_EN.webm", "/fileadmin/user_upload/scope/deutsch/Landshut.webm", "/fileadmin/user_upload/scope/englisch/Landshut_EN.webm", "/fileadmin/user_upload/scope/deutsch/Regensburg.webm", "/fileadmin/user_upload/scope/englisch/Regensburg_EN.webm", "/fileadmin/user_upload/scope/deutsch/Frauenchiemsee.webm", "/fileadmin/user_upload/scope/englisch/Frauenchiemsee_EN.webm", "/fileadmin/user_upload/scope/deutsch/Muehldorf.webm", "/fileadmin/user_upload/scope/englisch/Muehldorf_EN.webm", "/fileadmin/user_upload/scope/deutsch/Altoetting.webm", "/fileadmin/user_upload/scope/deutsch/Altoetting.webm", "/fileadmin/user_upload/scope/deutsch/Burghausen.webm", "/fileadmin/user_upload/scope/englisch/Burghausen_EN.webm", "/fileadmin/user_upload/scope/deutsch/BadReichenhall.webm", "/fileadmin/user_upload/scope/englisch/BadReichenhall_EN.webm", "/fileadmin/user_upload/scope/deutsch/Salzburg.webm", "/fileadmin/user_upload/scope/englisch/Salzburg_EN.webm", "/fileadmin/user_upload/scope/deutsch/Hallein.webm", "/fileadmin/user_upload/scope/englisch/Hallein_EN.webm", "/fileadmin/user_upload/scope/deutsch/Fluesse.webm", "/fileadmin/user_upload/scope/englisch/Fluesse_EN.webm", "/fileadmin/user_upload/scope/deutsch/Handel.webm", "/fileadmin/user_upload/scope/englisch/Handel_EN.webm", "/fileadmin/user_upload/scope/deutsch/Passau.webm", "/fileadmin/user_upload/scope/englisch/Passau_EN.webm", "/fileadmin/user_upload/scope/deutsch/Augsburg.webm", "/fileadmin/user_upload/scope/englisch/augsburg_EN.webm", "/fileadmin/user_upload/scope/deutsch/Muenchen.webm", "/fileadmin/user_upload/scope/englisch/muenchen_EN.webm", "/typo3/sysext/core/Resources/Public/Icons/Flags/PNG/DE.png", "/typo3/sysext/core/Resources/Public/Icons/Flags/PNG/GB.png", "/typo3conf/ext/visit_tablets/Resources/Public/Backend/images/ViSIT_Logo_web.png", "/typo3conf/ext/visit_tablets/Resources/Public/Backend/images/interreg.png", "/typo3conf/ext/visit_tablets/Resources/Public/fh-kufstein.svg", "/typo3conf/ext/visit_tablets/Resources/Public/Backend/images/ViSIT_Logo_web.png", "/typo3conf/ext/visit_tablets/Resources/Public/Backend/images/interreg.png", "/typo3conf/ext/visit_tablets/Resources/Public/fh-kufstein.svg"];

self.addEventListener("install", function (event) {
    self.skipWaiting();

    event.waitUntil(
        caches.open(CACHE).then(function (cache) {
            return cache.addAll(precacheFiles);
        })
    );
});

// Allow sw to control of current page
self.addEventListener("activate", function (event) {
    // console.log("[PWA Builder] Claiming clients for current page");
    event.waitUntil(self.clients.claim());
});

// If any fetch fails, it will look for the request in the cache and serve it from there first
self.addEventListener("fetch", function (event) {
    if (event.request.method !== "GET") return;

    event.respondWith(
        fromCache(event.request).then(
            function (response) {
                // The response was found in the cache so we responde with it and update the entry

                // This is where we call the server to get the newest version of the
                // file to use the next time we show view
                event.waitUntil(
                    fetch(event.request).then(function (response) {
                        return updateCache(event.request, response);
                    })
                );

                return response;
            },
            function () {
                // The response was not found in the cache so we look for it on the server
                return fetch(event.request)
                    .then(function (response) {
                        // If request was success, add or update it in the cache
                        event.waitUntil(updateCache(event.request, response.clone()));

                        return response;
                    })
                    .catch(function (error) {
                        console.log("[PWA Builder] Network request failed and no cache." + error);
                    });
            }
        )
    );
});

function fromCache(request) {
    // Check to see if you have it in the cache
    // Return response
    // If not in the cache, then return
    return caches.open(CACHE).then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status === 404) {
                return Promise.reject("no-match");
            }

            return matching;
        });
    });
}

function updateCache(request, response) {
    return caches.open(CACHE).then(function (cache) {
        return cache.put(request, response);
    });
}
