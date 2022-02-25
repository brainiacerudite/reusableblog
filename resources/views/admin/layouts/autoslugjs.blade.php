<script>
    $(document).ready(function() {
        $('#display_name').keyup(function(e) {
            var str = $('#display_name').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#slug').val(str);
            $('#slug').attr('placeholder', str);
        });
    });
</script>
