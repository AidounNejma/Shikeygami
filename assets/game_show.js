import './styles/game_show.css';

/*************************  CAROUSEL ANIMATION *********************************/

let back = document.querySelector(".back");
let forward = document.querySelector(".forward");

let slides = document.getElementsByClassName("containers");
let image = document.querySelector("#image");
let image2 = document.querySelector("#image2");
let image3 = document.querySelector("#image3");

let numImage = 1;

back.addEventListener("click", slideBack);
//console.log(back);
forward.addEventListener("click", slideNext);
//console.log(forward);

setInterval(slideNext, 5000);

function slideNext(){
    numImage += 1;
        if(numImage === 4){ 
            numImage = 1; 
        }
        slides[0].classList.toggle("fade");
        
        if(numImage === 1){
            image.style.display = "block";
            image2.style.display = "none";
            image3.style.display = "none";
        }
        if(numImage === 2){
            image2.style.display = "block";
            image.style.display = "none";
            image3.style.display = "none";
        }
        if(numImage === 3){
            image3.style.display = "block";
            image.style.display = "none";
            image2.style.display = "none";
        }

}

function slideBack() {
    numImage = numImage -1;
        if(numImage === 0){
            numImage = 4;
        }

        slides[0].classList.toggle("fade");
        if(numImage === 1){
            image.style.display = "block";
            image2.style.display = "none";
            image3.style.display = "none";
        }
        if(numImage === 2){
            image2.style.display = "block";
            image.style.display = "none";
            image3.style.display = "none";
        }
        if(numImage === 3){
            image3.style.display = "block";
            image.style.display = "none";
            image2.style.display = "none";
        }
} 

/**********************************************************/