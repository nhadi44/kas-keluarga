const showToas = (msg, gravity, position, bg) => {
    Toastify({
        text: msg,
        duration: 2000,
        newWindow: true,
        close: true,
        gravity: gravity, // `top` or `bottom`
        position: position, // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: bg,
        },
        onClick: function () {
            
        }, // Callback after click
    }).showToast();
};

export default showToas;
