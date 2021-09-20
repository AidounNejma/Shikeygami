 import'./styles/menu.css';


        var burger = document.getElementsByClassName('mobile');
        console.log(burger);

        var maNav =document.getElementsByTagName('nav');
        console.log(maNav);


        
        burger[0].addEventListener('click', changeStyle);


        function changeStyle(){
            console.log('la fonction style démarre');

            if(maNav[0].style.display=='block'){
            
                maNav[0].style.display="none";
                burger[0] .src ='/img/headerFooter/burger.png';
            } else {
                maNav[0].style.display='block';
                burger[0] .src ='/img/headerFooter/close.png';
            }
        } 


        
