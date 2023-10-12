$(function(){

    $('<div id="overlay-popup-recall"></div><div id="recall-form" class="recallmodal"><a class="close-popup-recall close-recall"></a><div><div class="popup-recall-title">'+plugin_popup+'</div><div class="popup-recall-cont"><div class="popup-recall-text1">'+plugin_popup_head+'</div><form method="POST" action="" class="popup-recall-form">'+plugin_country+'<input type="text" name="name" placeholder="'+plugin_name+'" required=""><input type="phone" name="phone" placeholder="'+plugin_phone+'" required=""><button class="call-btn">'+plugin_popup_recall_me+'</button></form><div class="popup-recall-bottom">'+plugin_popup_operator+'</div></div></div></div>').insertAfter("body");

    PopupModal.init();
});

var PopupModal = (function($, $n) {
    return $.extend($n, {
        init: function() {
            console.log('init');
            var current = this;   
            var timerId = false;
            var modalWindow = $("#recall-form");
            $(document).on('click', function(e) {
                if ((!(e.target.id == 'recall-form' || $(e.target).parents("#recall-form").length)
                    && !(e.target.id == 'recall-btn' || $(e.target).parents("#recall-btn").length))
                    || $(e.target).hasClass('close-recall')
                ){
                    // console.log('if e.target');
                    PopupModal.modalHide(modalWindow);
                }
            });
        },
        modalHide: function($modal) {
            console.log('modalHide');
            $modal.hide("fast", function() {
                if (!$(".recallmodal:visible").length) {
                    $("body").removeClass("recallmodal-show");
                }
                $("#overlay-popup-recall").hide();
            });
        },
        modalRefresh: function() {
            if ($(".recallmodal:visible:last").length) {
                var modalBlock = $(".recallmodal:visible:last .recallmodal-block"),
                    width = parseInt(modalBlock.width()),
                    height = parseInt(modalBlock.height());
                if ($(window).height() > height + 20) {
                    modalBlock.addClass("recallmodal-top").removeClass("margin-t-b").css("margin-top", -1 * (height / 2));
                } else {
                    modalBlock.addClass("margin-t-b").removeClass("recallmodal-top");
                }
                if ($(window).width() > width) {
                    modalBlock.addClass("recallmodal-left").removeClass("margin-l").css("margin-left", -1 * (width / 2));
                } else {
                    modalBlock.addClass("margin-l").removeClass("recallmodal-left");
                }
            }
        },
        panelQuickOrderHide: function() {
            var selector = $('#mobile_div');
            if (selector.length > 0) {
                selector.hide();
            }
        },

        panelQuickOrderShow: function() {
            var selector = $('#mobile_div');
            if (selector.length > 0) {
                selector.show();
            }
        },

        modalShow: function($modal) {
            console.log('modalShow');
            $modal.show("fast");
            $("body").addClass("recallmodal-show");
            this.modalRefresh();
            this.panelQuickOrderHide();
        },
        initModal: function(timeout) {
            console.log('initModal', timeout);
            var current = this;
            try {
                current.timerId = setTimeout(function start_PopupModalcomebacker() {
                    var comebacker = true;
                    var modalWindow = $("#recall-form");
                    PopupModal.modalShow(modalWindow);                            
                    $("#overlay-popup-recall").show();
                    $(document).on('click', function(e) {
                        if (!(e.target.id == 'recall-form' || $(e.target).parents("#recall-form").length) || $(e.target).hasClass('close-recall')){
                            PopupModal.modalHide(modalWindow);
                        }
                    });
                    return false;
                }, timeout);                
            } catch (e) {}
        },
        validateAndSendForm: function(jsonRequest, PopupModalText) {
            var current = this;
            $("#recall-form form").on("submit", function() {
                if (jsonRequest) {
                    current.prepareJsonData($(this));
                }
                $("input[name=name]", this).val($.trim($("input[name=name]", this).val()));
                if (!$("input[name=name]", this).val()) {
                    alert(PopupModalText.validation_name);
                    return false;
                }
                var phone_val = $("input[name=phone]", this).val();
                var is_popup = $("input[name=is_popup]", this).val();
                var reg1 = new RegExp("[^0-9]*", "g"),
                    reg2 = new RegExp("[^0-9-+ ()]", "g");
                var phone_txt = phone_val.replace(reg1, "");
                if (phone_val.search(reg2) != -1) {
                    alert(PopupModalText.validation_phone1);
                    return false;
                }
                if (!phone_txt || phone_txt.length < 7) {
                    alert(PopupModalText.validation_phone2);
                    return false;
                }
                current.showComebackerAlert = false;
                return true;
            });
        },
        prepareJsonData: function(form) {
            var datarow = form.serializeArray();
            $(datarow).each(function(item, itemData) {
                if (itemData.name == "name" || itemData.name == "phone" || itemData.name == "is_popup") {
                    delete datarow[item];
                }
            });
        },
        showComebackerAlert: true,
        initComebackerAlert: function(PopupModalText) {
            var current = this;
            window.onbeforeunload = function(evt) {
                if (current.showComebackerAlert) {
                    current.showComebackerAlert = false;
                    return PopupModalText.comebacker_text;
                }
            };
        }
    });
})(jQuery, PopupModal || {});