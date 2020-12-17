"use strict";

$('#add-image').click(function() {
    //recuperation de champs
    const index = +$('#widgets-counter').val();

    //rec prototype des entrées
    const tmpl = $('#ad_images').data('prototype').replace(/__name__/g, index);

    //j'injecte ce code au sein de la div
    $('#ad_images').append(tmpl);

    $('#widgets-counter').val(index + 1);

    //je gère le buton sup
    handleDeleteButtons();

});

function handleDeleteButtons(){
    $('button[data-action="delete"]').click(function (){
        const target = this.dataset.target;
        $(target).remove();
    });

}
function updateCounter(){
    const count = +$('#ad_images div.form-group').length;

    $('#widgets-counter').val(count);
}
updateCounter();
handleDeleteButtons();
