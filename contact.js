let navbar = document.querySelector('.navbar');

document.querySelector('#menuBtn').onclick = () => 
{
    navbar.classList.toggle('active');
}

window.onscroll = () => 
{
    navbar.classList.remove('active');
}