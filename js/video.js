window.addEventListener('DOMContentLoaded', function () {
    var videos = document.querySelectorAll('.js-support-video');

    videos.forEach(function (video) {
        var videoId = video.getAttribute('video-id');
        var moduleId = video.getAttribute('id');
        var service = video.getAttribute('service');
        var playBtn = video.querySelector('.js-support-video-play');
        playBtn.addEventListener('click', function () {
            playBtn.remove();

            switch (service) {
                case 'youtube':
                    moduleId = video.getAttribute('youtube-dom');
                    youtube(videoId, moduleId);
                    break;
                case 'vimeo':
                    vimeo(videoId, moduleId);
                    break;
            }

        });
    });

    function youtube(videoId, moduleId) {
        if (!document.querySelector('.youtube-api')) {
            var api = document.createElement('script');
            api.src = "https://www.youtube.com/iframe_api";
            api.setAttribute('class', 'youtube-api');
            document.head.appendChild(api);

            api.onload = function () {
                window.YT.ready(function () {
                    var player = new YT.Player(moduleId, {
                        height: '360',
                        width: '640',
                        videoId: videoId,
                        playerVars: {
                            'controls': 1,
                            'showinfo': 0,
                            'rel': 0,
                            'enablejsapi': 1,
                            'autoplay': 1,
                            'wmode': 'transparent'
                        },
                        events: {
                            'onReady': function (e) {
                                e.target.playVideo();
                                e.target.setPlaybackQuality('hd720');
                            }
                        }
                    });
                });
            };
        } else {
            var player = new YT.Player(moduleId, {
                height: '360',
                width: '640',
                videoId: videoId,
                playerVars: {
                    'controls': 1,
                    'showinfo': 0,
                    'rel': 0,
                    'enablejsapi': 1,
                    'autoplay': 1,
                    'wmode': 'transparent'
                },
                events: {
                    'onReady': function (e) {
                        e.target.playVideo();
                        e.target.setPlaybackQuality('hd720');
                    }
                }
            });
        }
    }

    function vimeo(videoId, moduleId) {
        if (!document.querySelector('.vimeo-api')) {
            var api = document.createElement('script');
            api.src = "https://player.vimeo.com/api/player.js";
            api.setAttribute('class', 'vimeo-api');
            document.head.appendChild(api);

            api.onload = function () {
                var options = {
                    id: videoId,
                    width: 640,
                    loop: false
                };

                var player = new Vimeo.Player(moduleId, options);

                player.play();
            };
        } else {
            var options = {
                id: videoId,
                width: 640,
                loop: false
            };
            var player = new Vimeo.Player(moduleId, options);
            player.play();
        }

    }
});

