<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("form").attr('novalidate', 'novalidate');
        $('.form-group').append('<div class="invalid-feedback"></div>');
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                let forms = document.getElementsByTagName('form');
                // Loop over them and prevent submission
                let validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            $('.form-control').each(function(i, obj) {
                                if(obj.validity.valid){
                                    $(this).closest('.form-group').find('.invalid-feedback').removeClass('d-inline');
                                }else if(obj.validity.valueMissing){
                                    $(this).closest('.form-group').find('.invalid-feedback').addClass('d-inline').text('Kolom ini tidak boleh kosong');
                                }else{
                                    $(this).closest('.form-group').find('.invalid-feedback').addClass('d-inline').text('Input tidak sesuai format');
                                }
                            });
                            $('.form-control-file').each(function(i, obj) {
                                if(obj.validity.valid){
                                    $(this).closest('.form-group').find('.invalid-feedback').removeClass('d-inline');
                                }else{
                                    $(this).closest('.form-group').find('.invalid-feedback').addClass('d-inline').text('Kolom ini tidak boleh kosong');
                                }
                            });
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    });
</script>
