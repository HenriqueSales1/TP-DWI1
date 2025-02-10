import { URL_BASE_API, URL_BASE_FRONT } from '../constantes/urls.js';

export async function checkSeLogadoNaApi() {
    const res = await fetch(`${URL_BASE_API}/autenticacao/check`);
    const json = await res.json();
    console.log(json);
    return json.logged;
}

export async function checkSeLogadoNaApiEMontaLink(a) {
    const logado = await checkSeLogadoNaApi();
    console.log(logado);
    if (!logado) {
        location.href = `${URL_BASE_FRONT}/autenticacao/login.html`;
    } else {
        a.innerHTML = 'Logout';
        a.href = `${URL_BASE_FRONT}/autenticacao/logout.html`;
    }
}