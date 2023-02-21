$(document).ready(function () {
    $('#create-short-url-btn').click(function (e) {
        e.preventDefault();

        const originalUrl = $('#original-url').val();

        $.ajax({
            url: 'php/shorten.php',
            method: 'POST',
            data: {
                'original-url': originalUrl
            },
            success: () => {
                location.reload();
            },
            error: (jqXHR) => {
                alert(jqXHR.responseText);
                $('#create-short-url').trigger('reset');
            }
        });
    });
});