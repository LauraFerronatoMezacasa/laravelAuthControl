document.addEventListener('DOMContentLoaded', function () {
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const selectAllCheckbox = document.getElementById('select_all_permissions');

    function updateSelectAllCheckbox() {
        const allChecked = Array.from(permissionCheckboxes).every(checkbox => checkbox.checked);
        selectAllCheckbox.checked = allChecked;
    }

    function checkRelatedPermissions() {
        const canViewUsers = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode visualizar usuários');
        const canCreateUsers = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode criar usuários');
        const canModifyUsers = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode modificar usuários');
        const canDeleteUsers = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode excluir usuários');

        const canViewAccessTypes = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode visualizar tipos de acesso');
        const canCreateAccessTypes = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode criar tipos de acesso');
        const canModifyAccessTypes = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode modificar tipos de acesso');
        const canDeleteAccessTypes = Array.from(permissionCheckboxes).find(checkbox => checkbox.dataset.description === 'Pode excluir tipos de acesso');

        if ((canCreateUsers && canCreateUsers.checked) || (canModifyUsers && canModifyUsers.checked) || (canDeleteUsers && canDeleteUsers.checked)) {
            canViewUsers.checked = true;
        }

        if ((canCreateAccessTypes && canCreateAccessTypes.checked) || (canModifyAccessTypes && canModifyAccessTypes.checked) || (canDeleteAccessTypes && canDeleteAccessTypes.checked)) {
            canViewAccessTypes.checked = true;
        }
    }

    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            updateSelectAllCheckbox();
            checkRelatedPermissions();
        });
    });

    selectAllCheckbox.addEventListener('change', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    updateSelectAllCheckbox();
    checkRelatedPermissions();
});