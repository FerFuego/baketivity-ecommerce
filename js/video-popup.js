/**
 * Video Popup
 */
class VideoPopup {

    constructor() {
        try {
            window.addEventListener('load', () => {
                this.videoModals = document.querySelectorAll('.js-video-modal');
                if (!this.videoModals) return;
                this.videoModals.forEach(function (videoModal, index) {
                    var btnCta = document.querySelector('.js-btn-video-play-' + index);
                    var videoPlay = videoModal.querySelector('.js-support-video-play');
                    var supportVideo = videoModal.querySelector('.js-support-video');

                    // Open Video
                    btnCta.addEventListener('click', () => {
                        videoPlay.click();
                        videoModal.classList.toggle('open');
                        if (!videoModal.classList.contains('open')) {
                            var ID = supportVideo.getAttribute('youtube-dom');
                            videoModal.querySelector('#' + ID).remove();
                            var newDiv = document.createElement('div');
                            newDiv.setAttribute('id', ID);
                            supportVideo.appendChild(newDiv);
                        }
                    });

                    // Close Video
                    videoModal.addEventListener('click', ({ target }) => {
                        if (target.classList.contains('js-video-modal') || target.classList.contains('js-close-modal')) {
                            videoModal.classList.toggle('open');
                            if (!videoModal.classList.contains('open')) {
                                var ID = supportVideo.getAttribute('youtube-dom');
                                videoModal.querySelector('#' + ID).remove();
                                var newDiv = document.createElement('div');
                                newDiv.setAttribute('id', ID);
                                supportVideo.appendChild(newDiv);
                            }
                        }
                    });
                });
            });
        } catch (error) {
            console.log(error);
        }
    }

    videoApiLoader(sectionToPrint, videoUrl) {
        try {
            sectionToPrint.querySelector('.vimeo-iframe-load').remove();
        } catch (error) {
            console.log(error);
        }

        var videoIframe = document.createElement('div');
        videoIframe.classList.add('vimeo-iframe-load');
        videoIframe.classList.add('video-info__iframe');

        this.resizeModalWithVideoResolution(player);

        sectionToPrint.appendChild(videoIframe);
    }

    resizeModalWithVideoResolution(player) {
        var self = this;
        player.on('loaded', function () {
            player.getVideoHeight().then(function (height) {
                player.getVideoWidth().then(function (width) {
                    if (height > width) {
                        self.videoModalInfoContainer.style.width = '300px';
                        self.videoModalContainer.style.width = '';
                    } else {
                        self.videoModalInfoContainer.style.width = '';
                        self.videoModalContainer.style.width = '100%';
                    }
                    self.loaderOnOff(false);
                });
            });
        });
    }
}

new VideoPopup();