window.addEventListener('DOMContentLoaded', (event) => {
  if (document.querySelector('.yt-video') == null) return;

  // Load the IFrame Player API code asynchronously.
  var tag = document.createElement("script");
  tag.src = "https://www.youtube.com/player_api";
  var firstScriptTag = document.getElementsByTagName("script")[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  // Replace the 'ytplayer' element with an <iframe> and

  // YouTube player after the API code downloads.
  var player;
  function onYouTubePlayerAPIReady() {
    const videoId = document.querySelector('.yt-video').dataset.ytId;
    player = new YT.Player("yt-video-0", {
      videoId: videoId,
      events: {
        onReady: onPlayerReady,
        onStateChange: cahngePlayerState,
      },
      playerVars: {
        autoplay: 1,
        controls: 0,
        showinfo: 0,
        modestbranding: 1,
        fs: 0,
        cc_load_policy: 0,
        iv_load_policy: 3,
        autohide: 1,
        playsinline: 1,
        mute: 1,
        loop: 1,
        rel: 0,
        version: 3,
        origin: window.location.href,
      },
    });
  }
  window.b_ytPlayer = player;

  function onPlayerReady(event) {
    event.target.setVolume(40);
    event.target.playVideo();
  }

  function cahngePlayerState(e) {
    // show video when loaded instead of thumb
    if (e.data == 1) {
      document.querySelector(".yt-video__media").style.display = "block";
    } else if (e.data == 0) {
      // document.querySelector(".yt-video__media").remove();
    }

    // loop video
    if (e.data === YT.PlayerState.ENDED) {
      player.playVideo();
    }
  }   

  function initYtVideos(items) {
    items.forEach((video, index) => {
      const ytId = video.dataset.ytId;

      const thumbs = getVideoThumb(ytId);

      makeVideoMarkup(video, index);
      setVideoThmbs(video, ytId);
    })
  }

  function getVideoThumb(id) {
    const thumbs = {
      thumb: `https://i.ytimg.com/vi/${id}/maxresdefault.jpg`,
      webp: `https://i.ytimg.com/vi_webp/${id}/maxresdefault.webp`,
      // thumb: `https://i.ytimg.com/vi/${id}/hqdefault.jpg`,
      // webp: `https://i.ytimg.com/vi_webp/${id}/hqdefault.webp`,
    }
    return thumbs;
  }

  function setVideoThmbs(video, id) {
    const {thumb, webp} = getVideoThumb(id);
    video._ytVideo.img.src = thumb;
    video._ytVideo.webp.srcset = webp;
    video._ytVideo.thumbs = {
      thumb,
      webp,
    }

  }

  function makeVideoMarkup(video, index) {

    if (video.classList.contains('video--marked-up')) return;

    let pic = document.createElement('picture');
    pic.classList.add('yt-video__pic');

    let img = document.createElement('img');
    img.classList.add('yt-video__img');

    let picWebp = document.createElement("source");
    picWebp.type = "image/webp";

    let mediaWrap = document.createElement('div');
    mediaWrap.classList.add('yt-video__media');

    let videoFrame = document.createElement('div');
    videoFrame.classList.add('yt-video__video');
    videoFrame.id = `yt-video-${index}`;

    pic.appendChild(picWebp);
    pic.appendChild(img);

    mediaWrap.appendChild(videoFrame);

    video.appendChild(pic);
    video.appendChild(mediaWrap);

    video._ytVideo = {
      pic,
      webp: picWebp,
      img,
      media: mediaWrap,
      videoFrame: videoFrame,
    };

    if (!video.classList.contains('yt-video--bg')) {
      const playButton = document.createElement('button')
      playButton.classList.add('yt-video__play');
      video.appendChild(playButton);

      playButton.addEventListener('click', initVideo);

      video._ytVideo.play = playButton;
    }

    video.classList.add('video--marked-up');
  }

    // let video = card.querySelector(videoIframeClassName);
    // // let play = card.querySelector($.playButtonClassName);
    // video.setAttribute("data-src", ytVideoUrl);
    // let videoClass = `js_video--${index}`;
    // video.classList.add(videoClass);


    // card.addEventListener("click", initVideo);

  function initVideo(e) {
    const card = e.target.closest('yt-video');
    // const iframe = 
    // console.log("yep");
    // if (card.classList.contains("js_lazy-init"))
    // card.classList.add("js_lazy-init");
    // video.src = video.getAttribute("data-src");
    // debugger;
    // card.removeEventListener("click", initVideo);
  }

  initYtVideos(document.querySelectorAll('.yt-video'));
});
