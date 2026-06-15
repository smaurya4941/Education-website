document.addEventListener('DOMContentLoaded', loadwebCustomData);

function loadwebCustomData () {
    $('.alert').delay(5000).slideUp(300);
    $('#gRecaptchaContainerCompanyRegistration').empty()
    setTimeout(function () {
        loadCaptchaForCompanyRegistration()
    },500)

    initializeJobsMegaMenu()
}

window.manageFrontAjaxErrors = function (data) {
    var errorDivId = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'editValidationErrorsBox';
    if (data.status == 404) {
        iziToast.error({
            title: 'Error!',
            message: data.responseJSON.message,
            position: 'topRight',
        });
    } else {
        printErrorMessage('#' + errorDivId, data);
    }
};

window.deleteFrontItem = function (url, tableId, header, callFunction = null) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'swal2-confirm btn fw-bold btn-danger mt-0',
            cancelButton: 'swal2-cancel btn fw-bold btn-bg-light btn-color-primary mt-0'
        },
        buttonsStyling: false
    })


    swalWithBootstrapButtons.fire({
        title: Lang.get('js.delete') + ' !',
        text: Lang.get('js.are_you_sure_want_to_delete') + '"' + header + '" ?',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: Lang.get('js.no'),
        confirmButtonText: Lang.get('js.yes'),
    }).then((result) => {
        if (result.isConfirmed) {
            deleteFrontItemAjax(url, tableId, header, callFunction = null);
        }
    });
};


function deleteFrontItemAjax(url, tableId, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function () {
         Livewire.dispatch('refreshDatatable')
         Livewire.dispatch('resetPage')
            swal({
                title: Lang.get('js.deleted') + ' !',
                text: header + Lang.get('js.has_been_deleted'),
                type: 'success',
                confirmButtonColor: '#009ef7',
                timer: 2000,
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal({
                title: '',
                text: data.responseJSON.message,
                type: 'error',
                confirmButtonColor: '#009ef7',
                timer: 5000,
            });
        },
    });
}

window.loadCaptchaForCompanyRegistration = function () {
    let captchaContainer = document.getElementById('gRecaptchaContainerCompanyRegistration');

    if (!captchaContainer) {
        return false;
    }

    captchaContainer.innerHTML = ''
    let recaptcha = document.createElement('div')

    // setTimeout(function () {
        grecaptcha.render(recaptcha, {
            'sitekey': siteKey,
            'callback': function (response) {
                $("#companyRegistrationBtn").attr("disabled", false);
            }
        })
        captchaContainer.appendChild(recaptcha)
    // }, 500)
}

function initializeJobsMegaMenu() {
    const megaDropdown = document.querySelector('.mega-dropdown');

    if (!megaDropdown) {
        return;
    }

    const tabs = megaDropdown.querySelectorAll('.jobs-mega-tab');
    const panels = megaDropdown.querySelectorAll('.jobs-mega-panel');
    const toggleButton = megaDropdown.querySelector('.jobs-mega-open-btn');
    const menuLinks = megaDropdown.querySelectorAll('.jobs-mega-link, .jobs-mega-simple-link');

    tabs.forEach((tab) => {
        tab.addEventListener('click', function () {
            const target = this.getAttribute('data-target');

            tabs.forEach((item) => item.classList.remove('is-active'));
            panels.forEach((panel) => panel.classList.remove('is-active'));

            this.classList.add('is-active');

            const targetPanel = megaDropdown.querySelector(target);
            if (targetPanel) {
                targetPanel.classList.add('is-active');
            }
        });
    });

    if (toggleButton) {
        toggleButton.addEventListener('click', function (event) {
            event.preventDefault();
            const isOpen = megaDropdown.classList.toggle('is-open');
            toggleButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        menuLinks.forEach((link) => {
            link.addEventListener('click', function () {
                megaDropdown.classList.remove('is-open');
                toggleButton.setAttribute('aria-expanded', 'false');
            });
        });

        document.addEventListener('click', function (event) {
            if (megaDropdown.contains(event.target)) {
                return;
            }

            megaDropdown.classList.remove('is-open');
            toggleButton.setAttribute('aria-expanded', 'false');
        });
    }
}
