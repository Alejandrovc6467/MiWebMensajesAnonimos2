


/* Funcion para mostrar y oculatr el  menu */
const navToggle = document.querySelector(".header_nav_toggle");
const navMenu = document.querySelector(".header_nav_menu");

const header = document.querySelector(".header");/*Esto es solo por detalles de apariencias, pero no esnecesario (por el tema del backDrop blur en la cabecerea) */

//cuando le doy click al navToggle
navToggle.addEventListener("click", () => {/*funcion anonima, pude haber utilizado la de abajo*/
  navMenu.classList.toggle("header_nav_menu_visible");//esto es todo este togle lo que hace es que si el elemento no tiene esa clase pues se la agrega y si la tiene se la quita y esa clase solo va estar disponible cuando la resolucion es menor a 785 y la configuracaion ya esta hecha en el css
  header.classList.toggle("header_new");/* ni esto, son solo detalles (backdrop blur en la cabecera)*/
});


/* Esto es para que se cierre el menu si preciono una opcion cuando este este abierto */
/* Podria utilizar la misma funcion para ahorrar codigo, pero es divivirlo para que sea mas entendible */
const navMenuList = navMenu.querySelectorAll("a");

function closeOpenNavMenu() {
  navMenu.classList.toggle("header_nav_menu_visible");//esto es todo este togle lo que hace es que si el elemento no tiene esa clase pues se la agrega y si la tiene se la quita y esa clase solo va estar disponible cuando la resolucion es menor a 785 y la configuracaion ya esta hecha en el css
  header.classList.toggle("header_new");/* ni esto, son solo detalles */
}

navMenuList.forEach(element => {/* recorro mi lista para aplicarle el addEvent */
  element.addEventListener("click", closeOpenNavMenu);
});







