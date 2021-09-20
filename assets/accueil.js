import './styles/accueil.css';

/*************************  CAROUSEL ANIMATION *********************************/

function SlideShow(n) {
    var i;

    var fade = document.getElementsByClassName("fade");
    var slides = document.getElementsByClassName("Containers");
    var circles = document.getElementsByClassName("dots");
    if (n > slides.length) {slidePosition = 1}
        if (n < 1) {slidePosition = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].classList.toggle("fade");
            slides[i].style.display = "none";
        }

    for (i = 0; i < circles.length; i++) {
        circles[i].className = circles[i].className.replace(" enable", "");
    }

    slides[slidePosition-1].style.display = "block";
    slides[i].classList.toggle("fade");
    circles[slidePosition-1].className += " enable";
} 

var slidePosition = 1;
SlideShow(slidePosition);

// Contrôle Suivant/Précédent
window.plusSlides = function (n) {
    SlideShow(slidePosition += n);

}

//  Contrôle des images
window.currentSlide= function(n) {
    SlideShow(slidePosition = n);
}

/**********************************************************/
var phone = document.getElementsByClassName("phone");
var address = document.getElementsByClassName("address");
var mail = document.getElementsByClassName("mail");
var facebook = document.getElementsByClassName("facebook");

var question = document.getElementsByClassName("question");
var googleMaps = document.getElementsByClassName("googleMaps");
var contact = document.getElementsByClassName("contact");
var contactForm = document.getElementsByClassName("contactForm");
var facebookLink = document.getElementsByClassName("facebookLink");

phone[0].addEventListener('click', showPhone);
address[0].addEventListener('click', showAddress);
mail[0].addEventListener('click', showMail);
facebook[0].addEventListener('click', showFacebook);

function showPhone(){
    question[0].style.display = "none";
    googleMaps[0].style.display = "none";
    contactForm[0].style.display = "none";
    facebookLink[0].style.display = "none";
    contact[0].style.display = "block";
}
function showAddress(){
    question[0].style.display = "none";
    contact[0].style.display = "none";
    contactForm[0].style.display = "none";
    facebookLink[0].style.display = "none";
    googleMaps[0].style.display = "block";
}
function showMail(){
    question[0].style.display = "none";
    googleMaps[0].style.display = "none";
    contact[0].style.display = "none";
    facebookLink[0].style.display = "none";
    contactForm[0].style.display = "block";
}
function showFacebook(){
    question[0].style.display = "none";
    googleMaps[0].style.display = "none";
    contact[0].style.display = "none";
    contactForm[0].style.display = "none";
    facebookLink[0].style.display = "block";
}
