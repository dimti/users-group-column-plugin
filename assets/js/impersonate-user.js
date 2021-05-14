$(document).ready(function () {
    $('.list-cell-type-partial .btn.oc-icon-user-secret').on('click', function (event) {
        $(this).request('impersonateuser::onLogin', {
        })

        event.stopPropagation()
    })
})
