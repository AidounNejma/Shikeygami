import './styles/menu.css';


        var burger = document.getElementsByClassName('burger');
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

        const cookieContainer = document.getElementsByClassName("wrapperCookie");
        // console.log(cookieContainer);

        const acceptBtn = document.getElementsByClassName("accept");
        // console.log(acceptBtn);

        acceptBtn[0].addEventListener("click", () => { //si on clic sur le bouton accepter
            document.cookie = "CookieBy=Shikeygami; max-age="+60*60*24*30;
            if(document.cookie){ // si le cookie est bien créé
                cookieContainer[0].classList.add("hide"); //cacher le cookie
            }else{
                alert("Le cookie n'as pas pu etre initialisé")
            }
        });

        let checkCookie = document.cookie.indexOf("CookieBy=Shikeygami"); // on cherche si le cookie shikeygami existe
        // si checkcookie n'existe pas on affiche le cookie, sinon on le cache
        checkCookie != -1 ? cookieContainer[0].style.display = "none": cookieContainer[0].style.display = "block";
        