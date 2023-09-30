$(document).ready(() => {
	
    $('#doc').on('click', () => {
        $('#pagina').load('documentacao.html');
    });

    $('#sup').on('click', () => {
        $('#pagina').load('suporte.html');
    });

    $('#dashboard').on('click', () => {
        window.location.reload();
    });


    $('#date').on('change', e => {
        let data = $(e.target).val();
        $.ajax({
            type: 'GET',
            url: 'app.php',
            data: `data=${data}`,
            dataType: 'json',
            success: response => { 
                console.log(response);
                $('#num_vendas').html(response.numeroVendas);
                $('#total_vendas').html(response.totalVendas);
                $('#clientes_ativos').html(response.cAtivos);
                $('#clientes_inativos').html(response.cInativos);
                $('#reclamacoes').html(response.reclamacoes);
                $('#elogios').html(response.elogios);
                $('#sugestoes').html(response.sugestoes);
                $('#despesas').html(response.despesas);
            },
            error: erro => {
                console.log(erro);
                alert(erro.responseText);
            }
        })
    });
})