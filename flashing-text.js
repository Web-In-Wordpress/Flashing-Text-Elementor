jQuery(document).ready(function($) {
    $('.flashing-text').each(function() {
        var speed = parseInt($(this).data('speed'));

        setInterval(function() {
            $(this).toggleClass('hidden');
        }.bind(this), speed);
    });
});
