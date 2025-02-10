import { URL_BASE_API } from '../constantes/urls.js';

async function realizaLogoutNaApi(e) {
    e.preventDefault();
    const res = await fetch(`${URL_BASE_API}/autenticacao/logout`);
    const json = await res.json();
}

window.addEventListener('load', realizaLogoutNaApi);