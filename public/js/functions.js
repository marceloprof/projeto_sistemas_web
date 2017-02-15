$(document).ready(function()
{
    $('#teste').click(function() {
        $('#retorno').load($(this).attr('href'));
        return false;
    });

    $('#listarAluno').click(function() {
        $.ajax($(this).attr('href'), {
            success: function(data, status) {
                $( "#retorno" ).load("./templates/aluno.phtml", function( response, status, xhr) {
                    $('#tableAluno').DataTable( {
                        data: data,
                        columns: [
                            { data: 'idcadastroAluno' },
                            { data: 'nome' },
                            { data: 'RG' },
                            { data: 'dataNascimento' },
                            { data: 'curso' }
                        ]
                    });
                });
            },
            error: function() {
                $('#retorno').text('Erro no serviço Listar Aluno.');
            }
        });
        return false;
    });
});