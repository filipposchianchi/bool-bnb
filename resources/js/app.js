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
function outputDropdown(data) {
    $("#addressList").html(address);
}

function keyUpQuery() {
    $("#address").keyup(function() {
        var query = $(this).val();

        if (query != "") {
            console.log(query);

            // var _token = $('input[name="_token"]').val();
            $.ajax({
                url:
                    "https://api.tomtom.com/search/2/geocode/" +
                    query +
                    ".json",
                method: "GET",
                data: {
                    countrySet: "IT",
                    extendedPostalCodesFor: "Addr",
                    key: "yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG"
                },
                success: function(data) {
                    var results = data["results"];
                    results.forEach(item => {
                        $("#addressList").append(
                            item["address"]["freeformAddress"]
                        );
                        // console.log(item["address"]["freeformAddress"]);
                    });
                }
            });
        }
    });
}

function init() {
    keyUpQuery();
}

$(document).ready(init);
