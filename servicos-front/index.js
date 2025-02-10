import { checkSeLogadoNaApiEMontaLink } from "./autenticacao/check.js";

window.addEventListener('pageshow', () => {
    checkSeLogadoNaApiEMontaLink(document.querySelector('#link_login'));
});
