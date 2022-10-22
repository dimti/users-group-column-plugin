$(document).ready(function () {
    $(document).on(
        "click",
        ".list-cell-type-partial .btn.oc-icon-user-secret",
        function (event) {
            $(this).request("impersonateuser::onLogin", {});
            event.stopPropagation();
        }
    );
});
