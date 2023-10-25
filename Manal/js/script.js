/*   Typing Annimation   */

/*var typed = new Typed(".typing",
{
	strings:["","Responsable","De Stages"],
	typeSpeed:100,
	BackSpeed:60,
	loop:true
})

/*   Aside   */

const nav = document.querySelector(".nav"),
		navList = nav.querySelectorAll("li"),
		totalNavList = navList.length,
		allSection = document.querySelectorAll(".section"),
		totalSection = allSection.length;
		for (let i=0; i<totalNavList; i++) 
		{
			const a = navList[i].querySelector("a");
			a.addEventListener("click",function() 
			{
				removeBackSection();
				for (let i=0; i<totalSection; i++) 
				{
					allSection[i].classList.remove("back-section");
				}
				for(let j=0; j<totalNavList; j++)
				{

					if (navList[j].querySelector("a").classList.contains("active")) 
					{
						addBackSection(j);
						//allSection[j].classList.add("back-section");
					}
					navList[j].querySelector("a").classList.remove("active");
				}
	
				this.classList.add("active")
				showSection(this);
				if(window.innerWidth < 1200)
				{
					asideSectionTogglerBtn();
				}
			})
		}
		function removeBackSection()
		{
			for (let i=0; i<totalSection; i++) 
				{
					allSection[i].classList.remove("back-section");
				}	
		}
		function addBackSection(num)
		{
			allSection[num].classList.add("back-section");
		}
		function showSection(element) 
		{
			for (let i=0; i<totalSection; i++) 
			{
				allSection[i].classList.remove("active");
			}
			const target = element.getAttribute("href").split("#")[1];
			document.querySelector("#" + target).classList.add("active")
		}
const navTogglerBtn = document.querySelector(".nav-toggler"),
		aside = document.querySelector(".aside");
		navTogglerBtn.addEventListener("click",() =>
		{
			asideSectionTogglerBtn();
		})
		function asideSectionTogglerBtn()
		{
			aside.classList.toggle("open");
			navTogglerBtn.classList.toggle("open");
			for (let i=0; i<totalSection; i++) 
			{
				allSection[i].classList.toggle("open");
			}
		}

/* end aside  */ 
/* show password function */
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
/* end function */    