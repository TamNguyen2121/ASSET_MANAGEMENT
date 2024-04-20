import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();



window.addEventListener('alert', (event) => {
    let data = event.detail;
    Swal.fire({
        position: data.position,
        icon: data.type,
        title: data.title,
        showConfirmButton: data.confirm,
        timer: data.timer
    })
})

window.addEventListener('confirm', (event) => {
    let data = event.detail;
    let userId = (data.userId);
    Swal.fire({
        title: data.title,
        text: data.text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: data.confirmText,
        cancelButtonText: data.cancelText,
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch(data.method, { id: userId });
            Swal.fire({
                title: "Đã thực hiện!",
                text: "",
                icon: "success"
            });
        }
    });
});
document.querySelectorAll('.page-item').forEach(function (item) {
    item.addEventListener('click', function (event) {
        Livewire.dispatch('resetMySelect');
    });
});

// document.addEventListener('livewire:navigated', () => {
//     console.log("navigated");
//     Livewire.start();
// })

// $(document).ready(function () {
//     $('#userSelect2').select2({
//         placeholder: "Chọn",
//         allowClear: true,
//     });
//     $('#userSelect2').on('change focus', function (event) {
//         Livewire.dispatch('updateUser', { id: event.target.value });
//         $(this).select2('close');
//         $(this).select2('open');
//     })
// });


