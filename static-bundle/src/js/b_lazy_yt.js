// #region lazyYT
/**

  Разметка:
  .js_lazy-yt[data-yt-id=""]>picture.js_lazy-yt__cover>img.js_lazy-yt__preview^iframe.js_lazy-yt__player


 */

window.addEventListener("DOMContentLoaded", (event) => {
  const lazyYT = {
    videoParents: document.querySelectorAll(".js_lazy-yt"),
    videoPicClassName: ".js_lazy-yt__cover",
    videoImgClassName: ".js_lazy-yt__preview",
    videoIframeClassName: ".js_lazy-yt__player",
  };
  setupLazyYT(lazyYT);
});
function setupLazyYT($) {
  const {
    videoParents,
    videoPicClassName,
    videoImgClassName,
    videoIframeClassName,
  } = $;

  videoParents.forEach((card, index) => {
    let ytId = card.getAttribute("data-yt-id");
    if (!ytId) return;

    // let ytThumbUrl = `https://i.ytimg.com/vi/${ytId}/hq720.jpg`;
    let ytThumbUrl = `https://i.ytimg.com/vi/${ytId}/hqdefault.jpg`;
    let ytThumbWebpUrl = `https://i.ytimg.com/vi_webp/${ytId}/hqdefault.webp`;
    let ytVideoUrl = `https://www.youtube.com/embed/${ytId}/?autoplay=1`;
    // let ytVideoUrl = `https://www.youtube.com/watch?v=${ytId}`;

    let pic = card.querySelector(videoPicClassName);
    let thumb = card.querySelector(videoImgClassName);
    let thumbWebp = document.createElement("source");
    thumbWebp.srcset = ytThumbWebpUrl;
    thumbWebp.type = "image/webp";
    pic.appendChild(thumbWebp);
    pic.appendChild(thumb);
    thumb.src = ytThumbUrl;

    let video = card.querySelector(videoIframeClassName);
    // let play = card.querySelector($.playButtonClassName);
    video.setAttribute("data-src", ytVideoUrl);
    let videoClass = `js_video--${index}`;
    video.classList.add(videoClass);

    function initVideo() {
      console.log("yep");
      // if (card.classList.contains("js_lazy-init"))
      card.classList.add("js_lazy-init");
      video.src = video.getAttribute("data-src");
      // debugger;
      card.removeEventListener("click", initVideo);
    }
    card.addEventListener("click", initVideo);
  });
}
// #endregion lazyYT
