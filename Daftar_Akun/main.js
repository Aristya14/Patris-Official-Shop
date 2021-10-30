const solutions = document.getElementById('#solutions');
const more = document.getElementById('#more');

solutions.addEventListener('click', ()=> {
    if (menu.classList.contains('hidden')){
        menu.classList.remove('hidden');
    }
    else{
        menu.classList.add('hidden');
    }
});

more.addEventListener('click', ()=> {
  if (menu.classList.contains('hidden')){
      menu.classList.remove('hidden');
  }
  else{
      menu.classList.add('hidden');
  }
});

function myFunction(a) {
  if (a.style.display === "none") {
    a.style.display = "block";
  } else {
    a.style.display = "none";
  }
}