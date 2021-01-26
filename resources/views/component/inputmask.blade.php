<!-- InputMask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("[mask-number]").inputmask('numeric', {
            groupSeparator: ".",
            radixPoint: ",",
            max: 999999999,
            placeholder: "",
            rightAlign: false,
            removeMaskOnSubmit: true
        });
    });
</script>="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
