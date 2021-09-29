import './styles/accueil.css';

/*************************  CAROUSEL ANIMATION *********************************/

let back = document.querySelector(".back");
let forward = document.querySelector(".forward");

let slides = document.getElementsByClassName("containers");
let image = document.querySelector("#image");
let sourceRef = document.querySelectorAll(".src-ref");
let titleRef = document.querySelectorAll(".title-ref");
// console.log(sourceRef);

let text = document.querySelector(".text");
// let links = document.querySelector("#links");
// let numImage = 1;

let i = 0;

back.addEventListener("click", slideBack);
//console.log(back);
forward.addEventListener("click", slideNext);
//console.log(forward);

setInterval(slideNext, 5000);

function slideNext() {
    // console.log(sourceRef.length)
    slides[0].classList.toggle("fade");
    if (i < sourceRef.length - 1){
        i++;
        image.src = sourceRef[i].innerHTML;
        text.textContent = titleRef[i].innerHTML;
        links.setAttribute('href', "/game/" + (i+1));
    } else {
        image.src = sourceRef[0].innerHTML;
        text.textContent = titleRef[0].innerHTML;
        links.setAttribute('href', "/game/1");
        i = 0;
    }
}
function slideBack() {
    slides[0].classList.toggle("fade");
    if (i == 0){
        i = sourceRef.length - 1;
    } else {
        i--;
    }
    image.src = sourceRef[i].innerHTML;
    text.textContent = titleRef[i].innerHTML;
    links.setAttribute('href', "/game/" + (i+1));
    slides[0].classList.toggle("fade");
}
// function slideNext(){
    //     numImage += 1;
    //         if(numImage === 5){ 
        //             numImage = 1; 
        //         }
        //         slides[0].classList.toggle("fade");
        //         image.src = 'img/carouselBanner/' + numImage + '.jpg';
        //         if(numImage === 1){
            //             text.textContent = "Yokai Exorcism";
            //         }
            //         if(numImage === 2){
                //             text.textContent = "Chikatsu";
                //             links.setAttribute('href', "/game");
                //         }
                
                //         if(numImage === 3){
                    //             text.textContent = "Horror";
                    //             links.setAttribute('href', "/game");
                    //         }
                    
                    //         if(numImage === 4){
//             text.textContent = "Test";
//             links.setAttribute('href', "/game");
//         }
// }


// function slideBack() {
    //     numImage = numImage -1;
    //         if(numImage === 0){
        //             numImage = 5;
        //         }
        //         if(numImage === 1){
            //             text.textContent = "Yokai Exorcism";
            //         }
            //         if(numImage === 2){
                //             text.textContent = "Chikatsu";
                //             links.setAttribute('href', "/game");
//         }

//         if(numImage === 3){
//             text.textContent = "Horror";
//             links.setAttribute('href', "/game");
//         }

//         if(numImage === 4){
//             text.textContent = "Test";
//             links.setAttribute('href', "/game");
//         }
//         slides[0].classList.toggle("fade");
//         image.src = 'img/carouselBanner/' + numImage + '.jpg';
// } 

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
