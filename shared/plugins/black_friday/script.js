function removeBunner() {
    var blackFridayContainer = document.querySelector(".black_friday__container");
    var blackFridayClose = document.querySelector(".black_friday__close");

    blackFridayClose.addEventListener("click", function (event) {
        event.preventDefault();

        blackFridayContainer.remove();
        document.body.setAttribute("style", "margin-top: 0px !important");
        document.body.classList.remove("black_friday__body");
    })
}

document.body.classList.add("black_friday__body");
removeBunner();
