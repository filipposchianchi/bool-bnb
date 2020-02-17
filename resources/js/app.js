/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// new Vue({
//     el: "#apartments"
// });
function ajaxCall(query) {
    $.ajax({
        url: "https://api.tomtom.com/search/2/geocode/" + query + ".json",
        method: "GET",
        data: {
            countrySet: "IT",
            extendedPostalCodesFor: "Addr",
            key: "yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG"
        },
        success: function(data) {
            // console.log("TEST");
            $("#addressList").fadeIn();
            $("#addressList").append(
                '<ul class="dropdown-menu" style="display:block; position:absolute">'
            );
            var results = data["results"];
            results.forEach(item => {
                $("#addressList ul").append(
                    '<li data-lat="' +
                        item["position"]["lat"] +
                        '" data-lon="' +
                        item["position"]["lon"] +
                        '"><a href="#">' +
                        item["address"]["freeformAddress"] +
                        "</a></li>"
                );
                console.log(item["position"]["lat"]);

                // $("#addressList").append(item["address"]["freeformAddress"]);
                // console.log(item["address"]["freeformAddress"]);
            });
            $("#addressList").append("</ul>");
        }
    });
}
function addressClick() {
    $(document).on("click", "li", function() {
        $("#latitude").val($(this).data("lat"));
        $("#longitude").val($(this).data("lon"));
        $("#address").val($(this).text());
        $("#addressList").fadeOut();
    });
}
function keyUpQuery() {
    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    // Example usage:

    $("#address").keyup(
        delay(function() {
            var query = $(this).val();
            $("#addressList").html("");

            if (query != "") {
                console.log(query);
                ajaxCall(query);
            }
        }, 1300)
    );
}

function init() {
    keyUpQuery();
    addressClick();
}

$(document).ready(init);
