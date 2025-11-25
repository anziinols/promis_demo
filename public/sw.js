// Install service worker
self.addEventListener('install', function(event) {
    event.waitUntil(
      caches.open('my-pwa-cache').then(function(cache) {
        return cache.addAll([
          '/',
          'assets/themes/noltheme/calendar_list.css',
          'assets/system_img/logo-192.png',
          'assets/system_img/logo-512.png'
        ]);
      })
    );
  });
  
  // Serve cached content
  self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request).then(function(response) {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
    );
  });
  