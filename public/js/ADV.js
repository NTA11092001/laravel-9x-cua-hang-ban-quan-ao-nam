const sidebanner1 = document.querySelector(".js-sidebanner1");
const sidebanner2 = document.querySelector(".js-sidebanner2");
const showsidebanner1 = document.querySelector(".js-showbanner1");
const showsidebanner2 = document.querySelector(".js-showbanner2");
const SidebannerClose1 = document.querySelector(".js-close-sidebanner1");
const SidebannerClose2 = document.querySelector(".js-close-sidebanner2");
function ShowSidebanner1(){
    showsidebanner1.classList.add("open");
}
function HideSidebanner1(){
    showsidebanner1.classList.remove("open");
}

function Showsidebanner2(){
    showsidebanner2.classList.add("open");
}
function HideSidebanner2(){
    showsidebanner2.classList.remove("open");
}

sidebanner1.addEventListener("click",ShowSidebanner1)
sidebanner2.addEventListener("click",Showsidebanner2)
SidebannerClose1.addEventListener("click",HideSidebanner1)
SidebannerClose2.addEventListener("click",HideSidebanner2)