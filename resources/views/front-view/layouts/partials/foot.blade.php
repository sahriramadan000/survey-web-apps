<script src="{{ asset('asset/js/jquery-3.7.1.min.js') }}"></script>
<!-- Common script -->
<script src="{{ asset('asset/js/common_scripts_min.js') }}"></script>
<!-- Theme script -->
<script src="{{ asset('asset/js/functions.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(session('success'))
        alert("{{ session('success') }}");
    @endif

    @if(session('error'))
        alert("{{ session('error') }}");
    @endif

    @if($errors->any())
        let errorMessages = @json($errors->all());
        alert("Terjadi kesalahan:\n\n" + errorMessages.join('\n'));
    @endif
</script>
@stack('scripts')
