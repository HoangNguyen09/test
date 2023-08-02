$(document).ready(function() {
   $('.slick').slick({
  slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        speed:2000,
        nextArrow:$('.next'),
        prevArrow:$('.prev'),
        dots:true
});
});


function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Xem thêm"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Thu gọn"; 
    moreText.style.display = "inline";
  }
}