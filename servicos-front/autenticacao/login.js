import { URL_BASE_API, URL_BASE_FRONT } from '../constantes/urls.js';

async function enviaDadosParaLoginNaAPI(e) {
    e.preventDefault();
    const dados = new FormData(e.target);
    const opt = {
        method: 'post',
        body: dados
    }
    const res = await fetch(`${URL_BASE_API}/autenticacao/login`, opt);
    const json = await res.json();
    
    if (json.logged) {
        location.href = `${URL_BASE_FRONT}/index.html`;
    } else {
        alert('Algum erro ao realizar o login');
    }
}
document.forms[0].addEventListener('submit', enviaDadosParaLoginNaAPI);
document.getElementById('btnAdmin').addEventListener('click', async (e) => {
    e.preventDefault();
    const opt = {
        method: 'post'
    };
    const res = await fetch(`${URL_BASE_API}/autenticacao/padrao`, opt);
    const json = await res.text();
    console.log(json);
    alert('Usuário criado!')
});