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

/*************************Gestion des boutons*********************************/

let buttons = document.querySelectorAll("button");
//console.log(buttons);

buttons[0].addEventListener("click", () => {
    Toggle(0);
});
buttons[1].addEventListener("click", () => {
    Toggle(1);
});
buttons[2].addEventListener("click", () => {
    Toggle(2);
});
buttons[3].addEventListener("click", () => {
    Toggle(3);
});
buttons[4].addEventListener("click", () => {
    Toggle(4);
});
buttons[5].addEventListener("click", () => {
    Toggle(5);
});

let text = document.querySelectorAll(".slideMessage");
//console.log(text);

text[0].addEventListener("click", () => {
    Toggle(0);
});
text[1].addEventListener("click", () => {
    Toggle(1);
});
text[2].addEventListener("click", () => {
    Toggle(2);
});
text[3].addEventListener("click", () => {
    Toggle(3);
});
text[4].addEventListener("click", () => {
    Toggle(4);
});
text[5].addEventListener("click", () => {
    Toggle(5);
});

function slide(){
        text[1].style.display = "block";
    }
    
function Toggle(number){
    
    if(number >= 5) // si on clique sur le dernier bouton
    {
        if((buttons[number-1].style.display == "none")){ // toggle visible
            for(let i=0; i < buttons.length; i++){
                buttons[i].style.display ="block";
                text[i].style.display = "none";  
            }
        }
        else{
            for(let i=0; i < buttons.length; i++)   //toggle invisible
            {
                if(buttons[i] == buttons[number])
                {
                    buttons[i].style.display ="block";
                    text[i].style.display = "block";
                }
                else{
                buttons[i].style.display ="none";
                text[i].style.display = "none";   
                }
            }
        }
    }
    else if(number <= 0){ //si on clic sur le premier bouton
        if((buttons[number+1].style.display == "none")){
            for(let i=0; i < buttons.length; i++){
                buttons[i].style.display ="block";
                text[i].style.display = "none";  
            }
        }
        else{
            for(let i=0; i < buttons.length; i++)
            {
                if(buttons[i] == buttons[number])
                {
                    buttons[i].style.display ="block";
                    text[i].style.display = "block";
                }
                else{
                buttons[i].style.display ="none";
                text[i].style.display = "none";   
                }
            }
        }
    }
    else{ //si on clic sur un bouton du centre
        if((buttons[number+1].style.display == "none")||(buttons[number-1].style.display == "none")){
            for(let i=0; i < buttons.length; i++){
                buttons[i].style.display ="block";
                text[i].style.display = "none";  
            }
        }
        else{
            for(let i=0; i < buttons.length; i++)
            {
                if(buttons[i] == buttons[number])
                {
                    buttons[i].style.display ="block";
                    text[i].style.display = "block";
                }
                else{
                buttons[i].style.display ="none";
                text[i].style.display = "none";   
                }
            }
        }
    }
    
    // for(let i=0; i < buttons.length; i++)
    // {
    //     if(buttons[i] == buttons[number])
    //     {
    //         buttons[i].style.display ="block";
    //         text[i].style.display = "block";
    //     }
    //     else{
    //     buttons[i].style.display ="none";
    //     text[i].style.display = "none";   
    //     }
    // }
    
}
