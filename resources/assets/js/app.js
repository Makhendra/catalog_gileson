// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

function wrapElemement(elem) {
    var card = document.createElement('div');
    card.classList = 'card card-flex';

    var img = document.createElement('img');
    img.src = elem.image;
    img.alt = elem.title;
    img.classList = 'card-img-top image-card min';

    var card_body = document.createElement('div');
    card_body.classList = 'card-body';

    var title = document.createElement('a');
    title.classList = 'card-title';
    title.innerText = elem.title;
    title.target = '_blanck';
    title.href = elem.url;

    var desc = document.createElement('p');
    desc.classList = 'card-text text-desc';
    desc.innerText = elem.description;

    var btn = document.createElement('a');
    btn.target = '_blanck';
    btn.href = elem.url;
    btn.classList = 'btn btn-primary';
    btn.innerText = 'Подробнее';

    card_body.appendChild(title);
    // card_body.appendChild(desc);
    // card_body.appendChild(btn);

    card.appendChild(img);
    card.appendChild(card_body);

    return card;
}

$('#search').submit(function (event) {
    event.preventDefault();

    var result_div = $('#result');
    result_div.empty();

    var search_text = $.trim($('#input-search').val());
    if (!$('#input-search').val()) {
        return false;
    }

    var form = $(this);
    var action = form.attr('action');
    var search = new FormData();
    search.append('search', search_text);

    $.ajax({
        method: "POST",
        url: action,
        data: search,
        contentType: false,
        processData: false,
        datatype: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('.close-search').removeClass('hidden');
            response.forEach(elem => {
                elem = wrapElemement(elem);
                result_div.append(elem);
            });
        },
        error: function (response) {
            console.log(response);
        }
    });

    return false;
});

$('.close-search').click(function () {
    $('#result').empty();
    $('.close-search').addClass('hidden');
});