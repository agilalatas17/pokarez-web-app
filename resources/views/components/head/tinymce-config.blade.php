<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tiny-mce', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | fontsizeinput | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | code | table'
    });
</script>
