import './styles/game.css'

const slider = document.querySelector('.slider-container'),
    slides = Array.from(document.querySelectorAll('.slide'))

let isDraggin = false,
    startPos = 0,
    currentTranslate = 0,
    prevTranslate = 0,
    animationID = 0,
    currentIndex = 0

slides.forEach((slide, index)=>{
    const slideImage = slide.querySelector('img')
    slideImage.addEventListener('dragstart', (e)=> e. preventDefault())

    //Touch events
    slide.addEventListener('touchstart', touchStart(index))
    slide.addEventListener('touchend', touchEnd)
    slide.addEventListener('touchmove', touchMove)
})

function touchStart(index){
    return function(event){
        console.log('start');
    }
}

function touchEnd(){
    console.log('end');
}

function touchMove(){
    console.log('move');
}