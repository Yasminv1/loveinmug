$(document).ready(function() {
    $('#redefinir-senha-form').submit(function(event) {
        event.preventDefault();

        var loginEmail = $('input[name="loginEmail"]').val();
        var codAcesso = $('input[name="codAcesso"]').val();
        var novaSenha = $('input[name="novaSenha"]').val();

        $.ajax({
            type: 'POST',
            url: '../controller/controlProcessarRedefinicaoSenha.php',
            data: {
                loginEmail: loginEmail,
                codAcesso: codAcesso,
                novaSenha: novaSenha
            },
            success: function(response) {
                $('#result').html(response);

            },
            error: function() {
                $('#result').html('Erro ao processar a solicitação.');
            }
        });
    });
});
