const signInBtn = document.querySelector("#signInBtn");
const signUpBtn = document.querySelector("#signUpBtn");
const container = document.querySelector(".container");

signUpBtn.addEventListener('click', () => {
    container.classList.add("signUpMode");
})

signInBtn.addEventListener('click', () => {
    container.classList.remove("signUpMode");
})
