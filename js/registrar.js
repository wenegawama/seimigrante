document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action="registrar.php"]');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const nome = document.getElementById('nome').value.trim();
        const celular = document.getElementById('celular').value.trim();
        const login = document.getElementById('login').value.trim();
        const senha = document.getElementById('senha').value.trim();

        let errors = [];

        if (nome.length < 2) {
            errors.push('Nome deve ter pelo menos 2 caracteres.');
        }

        if (!/^\d{8,15}$/.test(celular)) {
            errors.push('Celular deve conter apenas números e ter entre 8 e 15 dígitos.');
        }

        if (!login.includes('@')) {
            errors.push('Email inválido.');
        }

        if (senha.length < 6) {
            errors.push('A senha deve ter pelo menos 6 caracteres.');
        }

        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
        }
    });
});