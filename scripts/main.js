//Login Fields Animations
const inputs = document.querySelectorAll('.input');

function focusFunc() {
    let parent = this.parentNode.parentNode;
    parent.classList.add('focus');
};

function blurFunc() {
    let parent = this.parentNode.parentNode;
    if (this.value === '') {
        parent.classList.remove('focus');
    }
};
if (inputs) {
    inputs.forEach(inputs => {
        inputs.addEventListener('focus', focusFunc);
        inputs.addEventListener('blur', blurFunc);
    });
}

//Navigation Link Animations
const buttons = document.querySelectorAll('.btn');
if (buttons) {
    buttons.forEach(btn => {
        btn.addEventListener('mouseover', function (e) {
            let x = e.clientX - e.target.offsetLeft;
            let y = e.clientY - e.target.offsetTop;

            let ripples = document.createElement('span');
            ripples.className = 'btn-click'
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            this.appendChild(ripples);

            setTimeout(() => {
                ripples.remove()
            }, 1000);
        });
    });
}

//Password Validation
var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");
if (password && confirm_password) {
    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
}

var password1 = document.getElementById("password_trader")
    , confirm_password1 = document.getElementById("confirm_password_trader");
if (password1 && confirm_password1) {
    function validatePassword() {
        if (password1.value != confirm_password1.value) {
            confirm_password1.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password1.setCustomValidity('');
        }
    }

    password1.onchange = validatePassword;
    confirm_password1.onkeyup = validatePassword;
}

//Registration Page Slide
var form_spans = document.querySelectorAll('.form_span');
var span1 = document.querySelector('.span1');
var span2 = document.querySelector('.span2');
var customer_form = document.querySelector('.customer_form');
var trader_form = document.querySelector('.trader_form');
var title = document.querySelector('.register-form h3');
form_spans.forEach(form_span => {
    form_span.addEventListener('click', () => {
        if (form_span.innerHTML == 'Trader Form') {
            customer_form.style.transform = "translate(-450px)";
            customer_form.style.opacity = 0;
            trader_form.style.opacity = 1;
            customer_form.style.pointerEvents = "none";
            trader_form.style.pointerEvents = "all";
            trader_form.style.transform = "translate(0px)";
            title.innerHTML = "Become a trader";
            span2.classList.add('active-form');
            span2.classList.remove('inactive-form');
            span1.classList.add('inactive-form');
            span1.classList.remove('active-form');
        }
        if (form_span.innerHTML == 'Customer Form') {
            customer_form.style.transform = "translate(0px)";
            trader_form.style.transform = "translate(450px)";
            trader_form.style.opacity = 0;
            customer_form.style.opacity = 1;
            customer_form.style.pointerEvents = "all";
            trader_form.style.pointerEvents = "none";
            title.innerHTML = "Become a member";
            span1.classList.add('active-form');
            span1.classList.remove('inactive-form');
            span2.classList.add('inactive-form');
            span2.classList.remove('active-form');
        }
    });
});

//Timer Animation
const days = document.querySelector('.days')
const hours = document.querySelector('.hours')
const minutes = document.querySelector('.minutes')
const seconds = document.querySelector('.seconds')

if (days && hours && minutes && seconds)
{
    let timeLeft = {
        d: 0,
        h: 0,
        m: 0,
        s: 0,
    }
    
    let totalSeconds;
    
    function init() {
        totalSeconds = Math.floor((new Date('07/20/2021') - new Date()) / 1000);
        setTimeLeft();
        let interval = setInterval(() => {
            if (totalSeconds < 0) {
                clearInterval(interval);
            }
            countTime();
        }, 1000);
    }
    
    function countTime() {
        if (totalSeconds > 0) {
            --timeLeft.s;
            if (timeLeft.m >= 0 && timeLeft.s < 0) {
                timeLeft.s = 59;
                --timeLeft.m;
                if (timeLeft.h >= 0 && timeLeft.m < 0) {
                    timeLeft.m = 59;
                    --timeLeft.h;
                    if (timeLeft.d >= 0 && timeLeft.h < 0) {
                        timeLeft.h = 23;
                        --timeLeft.d;
                    }
                }
            }
        }
        --totalSeconds;
        printTime();
    }
    
    function printTime() {
        animateFlip(days, timeLeft.d);
        animateFlip(hours, timeLeft.h);
        animateFlip(minutes, timeLeft.m);
        animateFlip(seconds, timeLeft.s);
    }
    
    function animateFlip(element, value) {
        const valueInDom = element.querySelector('.bottom-back').innerText;
        const currentValue = value < 10 ? '0' + value : '' + value;
    
        if (valueInDom === currentValue) return;
    
        element.querySelector('.top-back span').innerText = currentValue;
        element.querySelector('.bottom-back span').innerText = currentValue;
    
    
        gsap.to(element.querySelector('.top'), 0.7, {
            rotationX: '-180deg',
            transformPerspective: 300,
            ease: Quart.easeOut,
            onComplete: function () {
                element.querySelector('.top').innerText = currentValue;
                element.querySelector('.bottom').innerText = currentValue;
                gsap.set(element.querySelector('.top'), { rotationX: 0 });
            }
        });
    
        gsap.to(element.querySelector('.top-back'), 0.7, {
            rotationX: 0,
            transformPerspective: 300,
            ease: Quart.easeOut,
            clearProps: 'all'
        });
    
    }
    
    
    
    function setTimeLeft() {
        timeLeft.d = Math.floor(totalSeconds / (60 * 60 * 24));
        timeLeft.h = Math.floor(totalSeconds / (60 * 60) % 24);
        timeLeft.m = Math.floor(totalSeconds / (60) % 60);
        timeLeft.s = Math.floor(totalSeconds % 60);
    }
    
    init();
}

//Load more content
const loadmore = document.querySelector('.load-more');
if (loadmore)
{
    let currentItems = 4;
    loadmore.addEventListener('click', (e) => {
        console.log('clicked');
        const elementList = [...document.querySelectorAll('.more-products .product-container')];
        console.log(elementList);
        for (let i = currentItems; i < currentItems + 4; i++)
        {
            if (elementList[i])
            {
                elementList[i].style.display = 'block';
            }
        }
        currentItems += 4;

        if (currentItems >= elementList.length)
        {
            event.target.style.display = 'none';
        }
    })
}

//For product image
let thumbnails = document.getElementsByClassName('thumbnail')

let activeImages = document.getElementsByClassName('active')

for (var i=0; i < thumbnails.length; i++){

	thumbnails[i].addEventListener('click', function(){
		console.log(activeImages)
		
		if (activeImages.length > 0){
			activeImages[0].classList.remove('active')
		}
		

		this.classList.add('active')
		document.getElementById('featured').src = this.src
	})
}

//For side buttons
let buttonRight = document.getElementById('slideRight');
let buttonLeft = document.getElementById('slideLeft');

if (buttonRight && buttonLeft){
    buttonLeft.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft -= 180
    })
    
    buttonRight.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft += 180
    })
}

// For Quantity
const plus = document.querySelector('.plus');
const minus = document.querySelector('.minus');
const count = document.querySelector('.count');
const stockInput = document.querySelector('.stock');
var max;

if (plus && minus && count && stockInput)
{
    const stock = stockInput.value;
    if (stock >= 20)
    {
        max = 20;
    }
    else
    {
        max = stock;
    }

minus.addEventListener('click', function() {
    if (count.value > 1) {
        count.value--;
        count.value = count.value;
    }
})
plus.addEventListener('click', function() {
        if (count.value < max)
        {
            count.value++;
            count.value = count.value;
        }
        console.log(count.value);
})
}

//For Product detail tabs
tabs= document.querySelectorAll('.tab');
tabContents= document.querySelectorAll('.tab-content');

tabs.forEach(function(tab){
    tab.addEventListener('click',function(){
        contentId = this.dataset.contentId;
        content = document.getElementById(contentId);

        tabContents.forEach(function(content){
            content.classList.remove('active');
        });

        tabs.forEach(function(tab){
            tab.classList.remove('active');
        });

        this.classList.add('active');
        content.classList.add('active');
    });
});

// //For ratings
// const ratingStars = [...document.getElementsByClassName("rating__star")];
// const ratingResult = document.querySelector(".rating__result");

// printRatingResult(ratingResult);

// function executeRating(stars, result) {
//    const starClassActive = "rating__star fas fa-star";
//    const starClassUnactive = "rating__star far fa-star";
//    const starsLength = stars.length;
//    let i;
//    stars.map((star) => {
//       star.onclick = () => {
//          i = stars.indexOf(star);

//          if (star.className.indexOf(starClassUnactive) !== -1) {
//             printRatingResult(result, i + 1);
//             for (i; i >= 0; --i) stars[i].className = starClassActive;
//          } else {
//             printRatingResult(result, i);
//             for (i; i < starsLength; ++i) stars[i].className = starClassUnactive;
//          }
//       };
//    });
// }

// function printRatingResult(result, num = 0) {
//    result.textContent = `${num}/5`;
// }

// executeRating(ratingStars, ratingResult);