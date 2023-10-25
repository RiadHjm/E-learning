$(document).ready(function(){

    $('.fa-bars').click(function(){
      $(this).toggleClass('fa-times');
      $('.navbar').toggleClass('nav-toggle');
    });
  
    $(window).on('scroll load',function(){
  
      $('.fa-bars').removeClass('fa-times');
      $('.navbar').removeClass('nav-toggle');
  
      if($(window).scrollTop() > 30){
        $('header').addClass('header-active');
      }else{
        $('header').removeClass('header-active');
      }
  
      $('section').each(function(){
        var id = $(this).attr('id');
        var height = $(this).height();
        var offset = $(this).offset().top - 200;
        var top = $(window).scrollTop();
        if(top >= offset && top < offset + height){
          $('.navbar ul li a').removeClass('active');
          $('.navbar').find('[href="#' + id + '"]').addClass('active');
        }
      });
  
    });
  
  });

var navbarLinks = document.querySelectorAll('.navbar a');

for (var i = 0; i < navbarLinks.length; i++) {
  navbarLinks[i].addEventListener('click', function(e) 
  {
    e.preventDefault();
    var targetId = this.getAttribute('href');
    var targetSection = targetId === "#" ? null : document.querySelector(targetId);
    var targetPosition = targetSection ? targetSection.offsetTop : 0;
    var startPosition = window.pageYOffset;
    var distance = targetPosition - startPosition;
    var duration = 500;
    var start = null;
  
    window.requestAnimationFrame(step);
  
    function step(timestamp) 
    {
      if (!start) start = timestamp;
      var progress = timestamp - start;
      window.scrollTo(0, easeInOutCubic(progress, startPosition, distance, duration));
      if (progress < duration) window.requestAnimationFrame(step);
    }
  
    function easeInOutCubic(t, b, c, d) 
    {
      t /= d/2;
      if (t < 1) return c/2*t*t*t + b;
      t -= 2;
      return c/2*(t*t*t + 2) + b;
    }
  });
}
  

