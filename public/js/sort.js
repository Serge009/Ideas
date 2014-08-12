/**
 * Created by олег on 05.08.14.
 */

// Массив елементов с соответствующим атрибутом
var mass_elem = [];

// Массив массивов
var mass_for_sort = [];
var index = null;
var value = null;

var elem_discussion = null;
var flag_sort = true;

$(document).ready(function() {

    $("#sort_time").bind("click", function() {
        //alert("sort_time");
        sortTime();
    });

    $("#sort_star").bind("click", function() {
        //alert("sort_star");
        sortStar();
    });

    $("#sort_comment").bind("click", function() {
        //alert("sort_comment");
        sortComment();
    });
});

function sortTime() {

    // Делаем массив пустым
    mass_for_sort = [];
    mass_elem = $("[data-time-create-discussion]");

    $.each(mass_elem, function(i, elem) {
        index = $(elem).attr("data-time-create-discussion");
        //alert(index);
        value = $(elem).closest("[data-id-discussion]").attr("data-id-discussion");
        //alert(value);
        // Добавили в конец массива
        mass_for_sort.push([index, value]);
    });
    /*
    alert(mass_for_sort[0][0]);
    alert(mass_for_sort[1][0]);
    alert(mass_for_sort[2][0]);
    */
    sortable();
}

function sortStar() {

    // Делаем массив пустым
    mass_for_sort = [];
    mass_elem = $("[data-star-discussion]");

    $.each(mass_elem, function(i, elem) {
        index = $(elem).attr("data-star-discussion");
        //alert(index);
        value = $(elem).closest("[data-id-discussion]").attr("data-id-discussion");
        //alert(value);
        // Добавили в конец массива
        mass_for_sort.push([index, value]);
    });

    /*
     alert(mass_for_sort[0][0]);
     alert(mass_for_sort[1][0]);
     alert(mass_for_sort[2][0]);
     */

    sortable();
}

function sortComment() {

    // Делаем массив пустым
    mass_for_sort = [];
    mass_elem = $("[data-count-comment]");

    $.each(mass_elem, function(i, elem) {
        index = $(elem).attr("data-count-comment");
        //alert(index);
        value = $(elem).closest("[data-id-discussion]").attr("data-id-discussion");
        //alert(value);
        // Добавили в конец массива
        mass_for_sort.push([index, value]);
    });

    sortable();
}


// Сортировка по соответствующему атрибуту
function sortable() {

    if(flag_sort) {
        mass_for_sort.sort(kSort);
        flag_sort = false;
    }
    else {
        mass_for_sort.sort(krSort);
        flag_sort = true;
    }
    $.each(mass_for_sort, function(index, value) {
        elem_discussion = $("[data-id-discussion = "+ value[1] +"]");
        $("#div_discussion").prepend($(elem_discussion).detach());
    });
}


// Сотрировка по возростанию
function kSort(a, b) {
    var a1 = a[0];
    var b1 = b[0];
    return a1 - b1;
}

// Сортировка по убыванию
function krSort(a, b) {
    var a1 = a[0];
    var b1 = b[0];
    return b1 - a1;
}
