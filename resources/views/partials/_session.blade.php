@if (session('success'))
    <script>
        new Noty({
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true,
        }).show();
    </script>
@endif
