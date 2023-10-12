function removeBunner() {
    var valentinesDayContainer = document.querySelector(".valentines_day__container");
    var valentinesDayClose = document.querySelector(".valentines_day__close");

    valentinesDayClose.addEventListener("click", function (event) {
        event.preventDefault();

        valentinesDayContainer.remove();
        document.body.setAttribute("style", "margin-top: 0px !important");
        document.body.classList.remove("valentines_day__body");
    })
}

document.body.classList.add("valentines_day__body");
removeBunner();
