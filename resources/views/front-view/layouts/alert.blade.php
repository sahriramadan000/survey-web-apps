@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Something Went Wrong!',
                html: '{!! implode('<br>', $errors->all()) !!}'
                // html: 'An unexpected error occurred. Please try again later.'
            });
        });
    </script>
@endif

@if (Session::has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ Session::get('success') }}'
            });
        });
    </script>
@endif


@if (Session::has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Something Went Wrong!',
                // text: '{{ Session::get('error') }}'
                text: 'An unexpected error occurred. Please try again later.'
            });
        });
    </script>
@endif
@if (Session::has('failed'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Something Went Wrong!',
                // text: '{{ Session::get('failed') }}'
                text: 'An unexpected error occurred. Please try again later.'
            });
        });
    </script>
@endif
