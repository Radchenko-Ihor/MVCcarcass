String.prototype.ucWords = function() {
    return this.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } );
};

$( "#markCar" ).change(function() {
    var mark = $("#markCar");
    if (mark.val() === 'all') {
        $("#form-reviews").attr('action', '/reviews').submit();
    } else {
        $("#form-reviews").attr('action', '/reviews/mark/' + mark.val()).submit();
    }
});

$("#modelCar").change(function () {
    var mark = $("#markCar");
    var model = $("#modelCar");
    if (mark.val() === 'all' && model.val() === 'all') {
        $("#form-reviews").attr('action', '/reviews').submit();
    } else if (model.val() === 'all') {
        $("#form-reviews").attr('action', '/reviews/mark/' + mark.val()).submit();
    } else {
        $("#form-reviews").attr('action', '/reviews/mark/' + mark.val() + '/model/' + model.val()).submit();
    }
});

$("#selectMark").change(function () {
    var markCar = $("#selectMark");
    var modelCar = $("#selectModel");
    if (markCar.val() === '') {
        modelCar.empty().append('<option>Модель</option>').prop("disabled", true);
    } else {
        $.post(
            '/reviews',
            {mark: markCar.val()},
            function (data) {
                modelCar.prop("disabled", false).empty().append('<option></option>');
                $.each($.parseJSON(data), function () {
                    modelCar.append("<option value='" + this.model.split(' ').join('-').toLowerCase() + "'>"
                        + this.model.toLowerCase().ucWords() + "</option>");
                });
            }
        )
    }
});

$(document).ready(function () {
    var currentPage = 1;
    $("#btn-moreReview").click(function () {
        var mark = $("#markCar");
        var model = $("#modelCar");
        var url = '';
        if (mark.val() === 'all' && model.val() === 'all') {
            url = '/reviews';
        } else if (model.val() === 'all') {
            url = '/reviews/mark/' + mark.val();
        } else {
            url = '/reviews/mark/' + mark.val() + '/model/' + model.val();
        }
        $.post(
            url,
            {page: ++currentPage},
            function (data) {
                $(data).hide().appendTo(".blog-main").fadeIn(1000);
                if (currentPage === totalPage) {
                    $("#btn-moreReview").remove();
                }
            }
        );
    });
});