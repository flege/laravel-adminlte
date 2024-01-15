@push('css')
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}">
@endpush
@push('js')
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
    @if (session('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: '{{ session('success')['message'] }}'
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: '{{ session('success')['message'] }}'
            })
        </script>
    @endif
@endpush
