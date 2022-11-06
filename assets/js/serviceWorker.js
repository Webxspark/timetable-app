const CACHE_NAME = "com.timetable-app.webxspark";
const assets = [
  './',
  './index',
  './assets/css/plugins.css',
  './assets/css/style.css',
  './assets/css/colors/sky.css',
  './assets/css/fonts/urbanist.css',
  './assets/js/plugins.js',
  './assets/js/theme.js',
  'https://cdn.webxspark.com/plugins/js/query.min.js',
  './assets/js/wxp.js',
  './assets/js/script.js',
];

self.addEventListener("fetch", fetchEvent => {
  fetchEvent.respondWith(
    caches.match(fetchEvent.request).then(res => {
      return res || fetch(fetchEvent.request)
    })
  )
})
self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      cache.addAll(assets)
    })
  )
})