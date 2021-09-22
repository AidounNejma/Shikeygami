import './styles/game_show.css';

/*************************  CAROUSEL ANIMATION *********************************/

let back = document.querySelector(".back");
let forward = document.querySelector(".forward");

let slides = document.getElementsByClassName("containers");
let image = document.querySelector("#image");

let numImage = 1;

back.addEventListener("click", slideBack);
//console.log(back);
forward.addEventListener("click", slideNext);
//console.log(forward);

setInterval(slideNext, 5000);

function slideNext(){
    numImage += 1;
        if(numImage === 3){ 
            numImage = 1; 
        }
        slides[0].classList.toggle("fade");
        image.src = '{{ dossier_images ~ game.imageUrl' + numImage + ' }}';
}

function slideBack() {
    numImage = numImage -1;
        if(numImage === 0){
            numImage = 3;
        }

        slides[0].classList.toggle("fade");
        image.src = '{{ dossier_images ~ game.imageUrl'+ numImage +' }}';
} 

/**********************************************************/