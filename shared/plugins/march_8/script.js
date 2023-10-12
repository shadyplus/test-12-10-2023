function removeBunner() {
    var valentinesDayContainer = document.querySelector(".march_8__container");
    var valentinesDayClose = document.querySelector(".march_8__close");

    valentinesDayClose.addEventListener("click", function (event) {
        event.preventDefault();

        valentinesDayContainer.remove();
        document.body.setAttribute("style", "margin-top: 0px !important");
        document.body.classList.remove("march_8__body");
    })
}

document.body.classList.add("march_8__body");
removeBunner();
