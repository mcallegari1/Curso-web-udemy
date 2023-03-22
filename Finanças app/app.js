class Despesa {
    constructor(dia, mes, ano, tipo, desc, valor){
        this.dia       = dia;
        this.mes       = mes;
        this.ano       = ano;
        this.tipo      = tipo;
        this.descricao = desc;
        this.valor     = valor;
    }

    isValid(){
        for(let i in this){
            if(this[i] == undefined || this[i] == '' || this[i] == null){
                return false;
            }
        }
        return true;
    }

    showDialogErro(){
        $('.modal-body').html('Preencha todos os campos!');
        $('.modal-footer button').removeClass('btn-sucess');
        $('.modal-footer button').addClass('btn-danger');
        $('#titleDialog').html('Erro na validação');
        $('#titleDialog').removeClass('text-success');
        $('#titleDialog').addClass('text-danger');
        $('#dialog').modal('show');
    }

    showDialogSucess(){
        $('.modal-body').html('Despesa adicionada com sucesso!');
        $('.modal-footer button').removeClass('btn-danger');
        $('.modal-footer button').addClass('btn-success');
        $('#titleDialog').html('Sucesso');
        $('#titleDialog').removeClass('text-danger');
        $('#titleDialog').addClass('text-success');
        $('#dialog').modal('show');
    }
}

class Bd {

    getNextId(){
        let lastKey = localStorage.getItem('lastid');
        if(!lastKey) lastKey = 0;
        return parseInt(lastKey) + 1;
    }

    save(d) {
        let id = this.getNextId();
        localStorage.setItem('lastid', id);
        localStorage.setItem(id, JSON.stringify(d));
    }

    getAllDespesas() {

        let result = Array();
        let lastId = localStorage.getItem('lastid');
        for(let i = 1; i <= lastId; i++){

            let despesa = JSON.parse(localStorage.getItem(i));

            if(despesa === null){
                continue;
            }

            result.push(despesa);
        }
        return result;
    }

    pesquisar(searchValues){

        let filterData = this.getAllDespesas();

        if(searchValues.ano != ''){
            filterData = filterData.filter(data => data.ano == searchValues.ano)
        }

        if(searchValues.mes != ''){
            filterData = filterData.filter(data => data.mes == searchValues.mes)
        }

        if(searchValues.dia != ''){
            filterData = filterData.filter(data => data.dia == searchValues.dia)
        }

        if(searchValues.tipo != ''){
            filterData = filterData.filter(data => data.tipo == searchValues.tipo)
        }

        if(searchValues.descricao != ''){
            filterData = filterData.filter(data => data.descricao == searchValues.descricao)
        }

        if(searchValues.valor != ''){
            filterData = filterData.filter(data => data.valor == searchValues.valor)
        }

        return filterData;
    }

}

let xBd = new Bd();

function cadastrarDespesa() {
    let dia   = document.getElementById('dia');
    let mes   = document.getElementById('mes');   
    let ano   = document.getElementById('ano');
    let tipo  = document.getElementById('tipo');
    let desc  = document.getElementById('descricao');
    let valor = document.getElementById('valor');

    let despesa = new Despesa(
        dia.value,
        mes.value,
        ano.value,
        tipo.value,
        desc.value,
        valor.value
    )

    if(despesa.isValid()){

        xBd.save(despesa)
        despesa.showDialogSucess();
        $('input').each(function() {
            $(this).val('');
        })
        $("select option[value='']").each(function() {
            $(this).attr('selected', 'selected');
        })

    } else {
        despesa.showDialogErro();
    }
}

function loadDespesas(allDesp = Array(), filter = false){

    if(allDesp.length === 0 && !filter){
        allDesp = xBd.getAllDespesas();
    }
    let objTable = document.getElementById('table_despesas');
    objTable.innerHTML = '';

    allDesp.forEach(function(bd) {
        let row = objTable.insertRow();

        let aTipos = {'1': 'Alimentação', '2': 'Educação', '3': 'Lazer', '4': 'Saúde'
            , '5': 'Transporte'};


        row.insertCell(0).innerHTML = `${bd.dia}/${bd.mes}/${bd.ano}`;
        row.insertCell(1).innerHTML = aTipos[bd.tipo];
        row.insertCell(2).innerHTML = bd.descricao; 
        row.insertCell(3).innerHTML = bd.valor;
    })
}

function pesquisaDespesa(){
    let dia   = document.getElementById('dia');
    let mes   = document.getElementById('mes');   
    let ano   = document.getElementById('ano');
    let tipo  = document.getElementById('tipo');
    let desc  = document.getElementById('descricao');
    let valor = document.getElementById('valor');

    let despesa = new Despesa(
        dia.value,
        mes.value,
        ano.value,
        tipo.value,
        desc.value,
        valor.value
    )

    let rowData = xBd.pesquisar(despesa);
    loadDespesas(rowData, true);
}
