import './styles/accueil.css';

/*************************  CAROUSEL ANIMATION *********************************/

let back = document.querySelector(".back");
let forward = document.querySelector(".forward");

let slides = document.getElementsByClassName("containers");
let image = document.querySelector("#image");

let text = document.querySelector(".text");
let links = document.querySelector("#links");

let numImage = 1;

back.addEventListener("click", slideBack);
//console.log(back);
forward.addEventListener("click", slideNext);
//console.log(forward);

setInterval(slideNext, 5000);

function slideNext(){
    numImage += 1;
        if(numImage === 5){ 
            numImage = 1; 
        }
        slides[0].classList.toggle("fade");
        image.src = 'img/carouselBanner/' + numImage + '.jpg';
        if(numImage === 1){
            text.textContent = "Yokai Exorcism";
        }
        if(numImage === 2){
            text.textContent = "Chikatsu";
            links.setAttribute('href', "/concept");
        }

        if(numImage === 3){
            text.textContent = "Horror";
            links.setAttribute('href', "/login");
        }

        if(numImage === 4){
            text.textContent = "Test";
            links.setAttribute('href', "/register");
        }
}

function slideBack() {
    numImage = numImage -1;
        if(numImage === 0){
            numImage = 5;
        }
        if(numImage === 1){
            text.textContent = "Yokai Exorcism";
        }
        if(numImage === 2){
            text.textContent = "Chikatsu";
            links.setAttribute('href', "/concept");
        }

        if(numImage === 3){
            text.textContent = "Horror";
            links.setAttribute('href', "/login");
        }

        if(numImage === 4){
            text.textContent = "Test";
            links.setAttribute('href', "/register");
        }
        slides[0].classList.toggle("fade");
        image.src = 'img/carouselBanner/' + numImage + '.jpg';
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
