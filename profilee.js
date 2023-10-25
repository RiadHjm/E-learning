let navbar = document.querySelector('.navbar');

document.querySelector('#menuBtn').onclick = () => 
{
    navbar.classList.toggle('active');
}

window.onscroll = () => 
{
    navbar.classList.remove('active');
}

const nextButton = document.querySelector('nav .next');
const prevButton = document.querySelector('nav .prev');
const submitButton = document.querySelector('nav .submit');
const indicatorSteps = document.querySelectorAll('.indicator');
const formShow = document.querySelectorAll('.form-child');
let active = 1;

nextButton.addEventListener('click', (e) => {
    e.preventDefault();
    active++;
    if(active > indicatorSteps.length)
    {
        active = indicatorSteps.length;
    }
    updateProgress();
});

prevButton.addEventListener('click', (e) => {
    e.preventDefault();
    active--;
    if(active < 1)
    {
        active = 1;
    }
    updateProgress();
});

const updateProgress = () => {
    if(indicatorSteps.length == active)
    {
        nextButton.style.display = 'none';
        submitButton.style.display = 'inline-block';
    }
    else 
    {
        nextButton.style.display = 'inline-block';
        submitButton.style.display = 'none';
    }

    indicatorSteps.forEach((step, i) => {
        if(i == (active - 1))
        {
            step.classList.add('active');
            formShow[i].classList.add('active');
        }
        else 
        {
            step.classList.remove('active');
            formShow[i].classList.remove('active');
        }
    });
}

document.querySelector('.fname').addEventListener('keyup', function() {
    document.querySelector('.firstname').innerHTML = this.value;
});

document.querySelector('.lname').addEventListener('keyup', function() {
    document.querySelector('.lastname').innerHTML = this.value;
});

document.querySelector('select[name="country"]').addEventListener('change', function() {
    document.querySelector('.nationality').innerHTML = this.value;
});

document.querySelector('input[name="birth_date"]').addEventListener('keyup', function() {
    document.querySelector('.day').innerHTML = this.value;
});

document.querySelector('input[name="birth_month"]').addEventListener('keyup', function() {
    document.querySelector('.month').innerHTML = this.value;
});

document.querySelector('input[name="birth_year"]').addEventListener('keyup', function() {
    document.querySelector('.year').innerHTML = this.value;
});