import './styles/game_show.css';

/*************************  CAROUSEL ANIMATION *********************************/

let back = document.querySelector(".back");
let forward = document.querySelector(".forward");

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

let buttons = document.querySelectorAll("button");
//console.log(buttons);

buttons[0].addEventListener("click", slide);
buttons[1].addEventListener("click", slide);
buttons[2].addEventListener("click", slide);
buttons[3].addEventListener("click", slide);
buttons[4].addEventListener("click", slide);
buttons[5].addEventListener("click", slide);

let text = document.querySelectorAll(".slideMessage");
//console.log(text);


function slide(){
        text[1].style.display = "block";
    }
    
    
    
