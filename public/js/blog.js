$(function () {
    $("a.ajax").click(function (ev) {
        var that = this;
        $.getJSON($(this).attr("href"), function (data) {
            window.alert(data.mensaje);
            $(that).parent().parent().hide();
        });
        ev.preventDefault();
    });
});
