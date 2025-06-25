function toggleAddModal() {
    const modal = document.getElementById('add-modal');
    const blurBg = document.getElementById('bgblr');
    modal.classList.toggle('show');
    blurBg.classList.toggle('show');
}

window.addEventListener('click', function (e) {
    const modal = document.getElementById('add-modal');
    const blurBg = document.getElementById('bgblr');
    const modalBox = document.querySelector('.addsmoothbox');
    const triggerBtn = document.getElementById('addbtn');

    if (
        modal.classList.contains('show') &&
        blurBg.classList.contains('show') &&
        !modalBox.contains(e.target) &&
        (!triggerBtn || !triggerBtn.contains(e.target))
    ) {
        modal.classList.remove('show');
        blurBg.classList.remove('show');
    }
});