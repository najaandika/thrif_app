export function initLoginModal() {
    const modal = document.getElementById('login-required-modal');
    if (!modal) return;

    const openModal = () => modal.classList.remove('hidden');
    const closeModal = () => modal.classList.add('hidden');

    document.querySelectorAll('[data-requires-login]').forEach((el) => {
        el.addEventListener('click', (event) => {
            if (el.tagName.toLowerCase() === 'a') {
                event.preventDefault();
            }
            openModal();
        });
    });

    modal.querySelectorAll('[data-close-modal]').forEach((closeBtn) => {
        closeBtn.addEventListener('click', closeModal);
    });
}
