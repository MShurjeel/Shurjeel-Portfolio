document.addEventListener('DOMContentLoaded', () => {
    // ===== Password show/hide (supports multiple fields via data-target) =====
    document.querySelectorAll('.password-toggle').forEach((icon) => {
        icon.addEventListener('click', () => {
            const targetId = icon.getAttribute('data-target');
            const field = document.getElementById(targetId);
            if (!field) return;

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    });

    // ===== Sidebar toggle (mobile) =====
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }

    // ===== Confirm before deleting a project =====
    document.querySelectorAll('.delete-form').forEach((form) => {
        form.addEventListener('submit', (e) => {
            const confirmed = window.confirm('Delete this project? This cannot be undone.');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });

    // ===== Auto-dismiss flash alerts =====
    const flashAlert = document.getElementById('flashAlert');
    if (flashAlert) {
        setTimeout(() => {
            flashAlert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            flashAlert.style.opacity = '0';
            flashAlert.style.transform = 'translateY(-0.5rem)';
            setTimeout(() => flashAlert.remove(), 400);
        }, 4000);
    }
});
