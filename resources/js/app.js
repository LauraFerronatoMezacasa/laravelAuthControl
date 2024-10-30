require('./bootstrap');

window.showAlert = function(title, text, icon, showCancelButton, textConfirm, callback) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: showCancelButton,
        confirmButtonText: textConfirm,
        cancelButtonText: 'Não',
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            if (typeof callback === 'function') {
                callback(); 
            }
        }
    });
};

window.confirmDelete = function(userId) {
    showAlert(
        'Tem certeza?', 
        'Você deseja excluir este usuário? Essa ação não pode ser desfeita!', 
        'warning',
        true,
        'Sim',
        function() { 
            document.getElementById('delete-form-' + userId).submit();
        }
    );
};

window.confirmDeleteRole = function(roleId) {
    showAlert(
        'Tem certeza?', 
        'Você deseja excluir este tipo de acesso? Essa ação não pode ser desfeita!', 
        'warning',
        true,
        'Sim',
        function() { 
            document.getElementById('delete-form-' + roleId).submit();
        }
    );
};

document.addEventListener('DOMContentLoaded', function () {
    const generatePasswordButton = document.getElementById('generate-password');
    if (generatePasswordButton) {
        generatePasswordButton.addEventListener('click', function() {
            const password = generateRandomPassword(12);
            document.getElementById('password').value = password;
        });
    }

    function generateRandomPassword(length) {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
        let password = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * chars.length);
            password += chars[randomIndex];
        }
        return password;
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});