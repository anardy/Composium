function teste(action, form_data) {
    $.ajax({
        type: 'POST',
        url: action,
        data: form_data,
        beforeSend: function() {
            $('#result').hide();
            $('#carregando').html('Pesquisando...').show();
        },
        success: function(response) {
            $('#carregando').hide();
            $('#result').html(response).show();
        }
    });
}