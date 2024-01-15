@push('js')
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
        $("[mask-number-clean]").inputmask('numeric', {
            max: 9999999999999,
            placeholder: "",
            rightAlign: false,
        });
    });
</script>
@endpush
