// Audio kontrolak
const playlistAudios = [
    '../audio/lightweight.m4a',
    '../audio/musicagym.m4a',
    '../audio/musicgym.m4a',
    '../audio/gymusic.mp3'
];
let currentAudioIndex = 0;

function playAudio() {
    var audio = document.getElementById("mainAudio");
    if(audio) audio.play();
}

function pauseAudio() {
    var audio = document.getElementById("mainAudio");
    if(audio) audio.pause();
}

function volumeUpAudio() {
    var audio = document.getElementById("mainAudio");
    if (audio && audio.volume < 1) audio.volume = Math.min(1, audio.volume + 0.1);
}

function volumeDownAudio() {
    var audio = document.getElementById("mainAudio");
    if (audio && audio.volume > 0) audio.volume = Math.max(0, audio.volume - 0.1);
}

function advanceAudio() {
    currentAudioIndex++;
    if (currentAudioIndex >= playlistAudios.length) {
        currentAudioIndex = 0;
    }
    changeAudio(playlistAudios[currentAudioIndex]);
}

function rewindAudio() {
    currentAudioIndex--;
    if (currentAudioIndex < 0) {
        currentAudioIndex = playlistAudios.length - 1;
    }
    changeAudio(playlistAudios[currentAudioIndex]);
}

function changeAudio(audioSrc) {
    var audio = document.getElementById("mainAudio");
    if(audio) {
        audio.src = audioSrc;
        audio.load();
        audio.play();
        
        const index = playlistAudios.indexOf(audioSrc);
        if (index !== -1) {
            currentAudioIndex = index;
        }
    }
}

// Bideo kontrolak
var video = document.getElementById("bideoa");

function playVideo() {
    video.play();
}

function pauseVideo() {
    video.pause();
}

function muteVideo() {
    video.muted = !video.muted;
}
function volumeUpVideo() {
    if (video.volume < 1) video.volume = Math.min(1, video.volume + 0.1);
}

function volumeDownVideo() {
    if (video.volume > 0) video.volume = Math.max(0, video.volume - 0.1);
}

const playlistVideos = [
    '../video/biceps.mp4',
    '../video/espalda.mp4',
    '../video/gluteo.mp4',
    '../video/pecho.mp4',
    '../video/pierna.mp4'
];
let currentVideoIndex = 0;

function advanceVideo() {
    currentVideoIndex++;
    if (currentVideoIndex >= playlistVideos.length) {
        currentVideoIndex = 0;
    }
    changeVideo(playlistVideos[currentVideoIndex]);
}

function rewindVideo() {
    currentVideoIndex--;
    if (currentVideoIndex < 0) {
        currentVideoIndex = playlistVideos.length - 1;
    }
    changeVideo(playlistVideos[currentVideoIndex]);
}

function changeVideo(videoSrc) {
    var video = document.getElementById("bideoa");
    video.src = videoSrc;
    video.load();
    video.play();

    const index = playlistVideos.indexOf(videoSrc);
    if (index !== -1) {
        currentVideoIndex = index;
    }
}

// Galeria kontrolak
let currentTranslate = 0;

function updateButtonsState() {
    const prevBtn = document.querySelector('.gallery-btn.prev');
    const nextBtn = document.querySelector('.gallery-btn.next');
    const track = document.querySelector('.gallery-track');
    const container = document.querySelector('.gallery-window');

    if (!track || !container) return;

    const maxTranslate = Math.max(0, track.scrollWidth - container.offsetWidth);

    if (prevBtn) {
        prevBtn.disabled = currentTranslate <= 0;
        prevBtn.style.opacity = currentTranslate <= 0 ? "0.5" : "1";
        prevBtn.style.cursor = currentTranslate <= 0 ? "default" : "pointer";
    }
    if (nextBtn) {
        nextBtn.disabled = currentTranslate >= maxTranslate;
        nextBtn.style.opacity = currentTranslate >= maxTranslate ? "0.5" : "1";
        nextBtn.style.cursor = currentTranslate >= maxTranslate ? "default" : "pointer";
    }
}

function moveGallery(direction) {
    const track = document.querySelector('.gallery-track');
    const items = document.querySelectorAll('.gallery-item');
    const container = document.querySelector('.gallery-window');

    if (!track || !container || items.length === 0) return;

    const style = window.getComputedStyle(track);
    const gap = parseInt(style.gap) || 0;
    const itemWidth = items[0].offsetWidth + gap;

    const maxTranslate = Math.max(0, track.scrollWidth - container.offsetWidth);

    if (direction === 1) {
        currentTranslate += itemWidth;
    } else {
        currentTranslate -= itemWidth;
    }

    if (currentTranslate < 0) {
        currentTranslate = 0;
    } else if (currentTranslate > maxTranslate) {
        currentTranslate = maxTranslate;
    }

    track.style.transform = `translateX(-${currentTranslate}px)`;
    updateButtonsState();
}

// Initialize on load
window.addEventListener('load', () => {
    updateButtonsState();
});

// Update on resize
window.addEventListener('resize', () => {
    currentTranslate = 0;
    const track = document.querySelector('.gallery-track');
    if (track) track.style.transform = `translateX(0px)`;
    updateButtonsState();
});