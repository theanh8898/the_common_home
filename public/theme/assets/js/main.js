

$(document).ready(function(){
  var swiper = new Swiper('#main-slider', {
    speed: 1800,
    loop: true,
    lazy: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    autoplay: {
      delay: 6000,
      disableOnInteraction: false,
    },
  });

  $('.videos-carousel').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    pageDots: false
  });

  window.addEventListener("scroll",function () {
    let header = document.querySelector(".site-header");
    let win = $(window);
    let winH = win.height();
    header.classList.toggle("sticky",window.scrollY > winH )
  });

  showMainMenu();

  showFindRoom();

  let btnDown = $('.btn-down');
  btnDown.click(function () {
    let heigtHeader = $('.site-header').height();
    smoothScroll('#home-page', 1000, heigtHeader);
  });


  /*Category bars*/

  let categoryBar = $('.category-bar .title');
  categoryBar.click(function () {
    $('.categories').toggleClass('show');
  });

  /*!Category bars*/
  if ($('.grid').length) {
	$('.grid').masonry({
		// options
		itemSelector: '.grid-item',
		columnWidth: '.grid-sizer',
		percentPosition: true,
		gutter: '.gutter-sizer',
	});
  }

});


function showMainMenu() {
  let btnMenu = $('.btn-menu-bars');
  let menu = $('.lef-bar-menu');
  let backdrop = $('.backdrop');
  btnMenu.click(function() {
    btnMenu.toggleClass("click");
    menu.toggleClass('show');
    backdrop.toggleClass('show');
    croopBody();
  });
}

function croopBody() {
  $('body').toggleClass('cropped');
}

function showFindRoom() {
  let btnFind = $('.find-room');
  btnFind.click(function () {
    btnFind.toggleClass('show')
    croopBody()
  })
}

function smoothScroll(target,duration, param) {
  var target = document.querySelector(target);
  var targetPosition = target.getBoundingClientRect().top;
  var startPosition = window.pageYOffset;
  var distance = targetPosition - startPosition - param;
  var startTime = null;

  function animation (currentTime) {
    if(startTime === null) startTime = currentTime;
    var timeElapsed = currentTime - startTime;
    var run = ease(timeElapsed, startPosition, distance, duration);
    window.scrollTo(0, run);
    if(timeElapsed < duration) requestAnimationFrame(animation);
  }

  function ease(t, b, c, d) {
    t /= d / 2;
    if (t < 1 ) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
  }

  requestAnimationFrame(animation);

}
