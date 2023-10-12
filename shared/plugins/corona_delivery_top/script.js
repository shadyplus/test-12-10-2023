function removeSafeDeliveryBunner() {
  var coronaWrapper = document.querySelector('#corona_banner');
  var coronaClose = document.querySelector('.corona-wrapper-close');

  coronaClose.addEventListener('click', function(evt) {
    evt.preventDefault();

    coronaWrapper.remove();
    $('body').removeClass('corona-body');
  })
}
$('body').addClass('corona-body');
removeSafeDeliveryBunner();
