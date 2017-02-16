$(document).ready(function()
{
    $('#dataNascimentoAluno').mask("00/00/0000", {placeholder: "__/__/____"});

    $('#teste').click(function() {
        $('#retorno').load($(this).attr('href'));
        return false;
    });

    $('#salvarAluno').click(function() {
        var action = $('#formAluno').attr("action");
        var nome = $('#nomeAluno').val();
        var RG = $('#rgAluno').val();
        var dataNascimento = $('#dataNascimentoAluno').val();
        var curso = $('#cursoAluno').val();
        var msg = compararData(dataNascimento);

        $('.nome td').css({"color":""});
        $('.rg td').css({"color":""});
        $('.data td').css({"color":""});
        $('.curso td').css({"color":""});

        $('#msg').html('');
        $('#msg').hide();

        if(!nome) {
            $('.nome td').css({"color":"red"});
            $('#nomeAluno').focus();
            return false;
        }
        if(!RG) {
            $('.rg td').css({"color":"red"});
            $('#rgAluno').focus();
            return false;
        }
        if(!dataNascimento) {
            $('.data td').css({"color":"red"});
            $('#dataNascimentoAluno').focus();
            return false;
        } else {
            if(msg) {
                $('#msg').show();
                $('#msg').html('<font color="red">'+msg+'</font>');
                $('.data td').css({"color":"red"});
                $('#dataNascimentoAluno').focus();
                return false;
            }
        }
        if(!curso) {
            $('.curso td').css({"color":"red"});
            $('#cursoAluno').focus();
            return false;
        }

        $('#msg').show();
    });

    function compararData(dataDMY) {
        var date = dataDMY.split("/");
        var dia = date[0];
        var mes = date[1];
        var ano = date[2];

        if( (dia > 31 || dia < 1) || (mes > 12 || mes < 1))
            return 'Data Nasc. possui formato inválido.';
        else
            date = ano+ '' + mes+ '' + dia;

        var data = new Date();
        var hoje = new Date();
        var hoje = data.getFullYear()+''+("0" + (data.getMonth() + 1)).substr(-2)+''+("0" + data.getDate()).substr(-2);

        if(date > hoje)
            return 'Data Nasc. maior que a data atual.';
    }
});