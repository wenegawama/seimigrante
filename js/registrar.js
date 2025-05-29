const form = document.getElementById('cadastro');
const campos = document.querySelectorAll('.required');
const spans = document.querySelectorAll('.span-required');

const nomeRegex = /^([a-zA-Z]{2,})(\s[a-zA-Z]{2,})+$/

function setError(index) {
    campos[index].style.border = '2px solid #e63636';
    spans[index].style.display = 'block';
}
function removeError(index) {
    campos[index].style.border = '';
    spans[index].style.display = 'none';
}

function validateNome() {
    if (!nomeRegex.test(campos[0].value)) {
        setError(0)
    } else {
        removeError(0);
    }
}