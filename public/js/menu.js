const btnSearch = document.querySelector(".js-button-search");
const search = document.querySelector(".js-search");
const navmenu = document.querySelector(".js-navmenu");

function showSearch() {
    search.classList.add("show");
}

function hideSearch() {
    search.classList.remove("show");
}

btnSearch.addEventListener("click", showSearch);
navmenu.addEventListener("click", hideSearch);

btnSearch.addEventListener("click", function (event) {
    event.stopPropagation();
});

search.addEventListener("click", function (event) {
    event.stopPropagation();
});