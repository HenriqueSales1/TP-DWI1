import { URL_BASE_API } from '../constantes/urls.js';
import { checkSeLogadoNaApiEMontaLink } from '../autenticacao/check.js';

async function buscaDaApiExibeNaTabela() {
    const res = await fetch(`${URL_BASE_API}/servico/listar`);
    const data = await res.json();
    const tbody = document.querySelector('tbody');
    tbody.innerHTML = '';
    for (let i = 0; i < data.length; i++) {
        const tr = document.createElement('tr');
        const td1 = document.createElement('td');
        const td2 = document.createElement('td');
        const td3 = document.createElement('td');
        const btEd = document.createElement('button');
        const btEx = document.createElement('button');
        btEd.innerText = 'Editar';
        btEd.setAttribute('data-id', data[i].id);
        btEd.addEventListener('click', preencheDadosParaEdicao);
        btEx.innerText = 'Apagar';
        btEx.setAttribute('data-id', data[i].id);
        btEx.addEventListener('click', solicitaExclusaoDeServicoNaApi);
        td1.innerText = data[i].jogo;
        td2.innerText = data[i].descricao;
        td3.append(btEd, btEx);
        tr.append(td1, td2, td3);
        tbody.append(tr);
    }
}

async function preencheDadosParaEdicao(e) {
    document.forms[0].id.value = e.target.getAttribute('data-id');
    const dados = new FormData();
    dados.append('id', e.target.getAttribute('data-id'));
    const opt = {
        method: 'post',
        body: dados
    };
    const res = await fetch(`${URL_BASE_API}/servico/um`, opt);
    const data = await res.json();
    console.log(data);
    document.forms[0].id.value = data.id;
    document.forms[0].jogo.value = data.jogo;
    document.forms[0].descricao.value = data.descricao;
}

async function enviaDadosParaCadastroOuEdicaoNaApi(e) {
    e.preventDefault();
    const opt = {
        method: 'post',
        body: new FormData(e.target)
    };
    let op = '';
    if (document.forms[0].id.value) {
        op = 'editar';
    } else {
        op = 'inserir';
    }
    const res = await fetch(`${URL_BASE_API}/servico/${op}`, opt);
    const data = await res.json();
    e.target.reset();
    document.forms[0].id.value = '';
    alert(data.status);
    buscaDaApiExibeNaTabela();
}

async function solicitaExclusaoDeServicoNaApi(e) {
    const dados = new FormData();
    dados.append('id', e.target.getAttribute('data-id'));
    const opt = {
        method: 'post',
        body: dados
    };
    const res = await fetch(`${URL_BASE_API}/servico/excluir`, opt);
    const data = await res.json();
    alert(data.status);
    buscaDaApiExibeNaTabela();
}

document.forms[0].addEventListener('submit', enviaDadosParaCadastroOuEdicaoNaApi);
window.addEventListener('pageshow', () => {
    checkSeLogadoNaApiEMontaLink(document.querySelector('#link_login'));
    buscaDaApiExibeNaTabela();
});
