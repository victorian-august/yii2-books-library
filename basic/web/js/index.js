$(document).ready(function () {
    var body = $('body');

    body.on('click', '.button-view', function (e) {
        var href = $(this).attr('href');
        var self = this;
        var modal_title = $('.modal-title');
        var modal_body = $('.modal-body');
        var modal_footer = $('.modal-footer');
        var button_close = $('.modal-footer .btn-default').clone();
        $.get(href, function (data) {
            var pjax_id = $(self).closest('.pjax-wrapper').attr('id');
            $.pjax.reload('#' + pjax_id);
            modal_title.html($(data).find('h1').text());
            modal_footer.html($(data).find('h1').next().html());
            button_close.appendTo(modal_footer);
            modal_body.html($(data).find('h1').next().next().clone());
            $('#modalView').modal();
        });
        return false;
    });

    body.on('click', '.preview', function (e) {
        var bigsize = "200";
        var smallsize = "50";

        if (this.width == bigsize)
            this.width = smallsize;
        else
            this.width = bigsize;
    });

    $('.view-preview').click(function () {
        $('.book-preview').toggle();
    });
});