@push('scripts')
<script>
    (function($){
        "use strict";
        $(document).ready(function() {

            $(document).on('submit','#formData', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $("#save_button_parent").prop('disabled', true);
                $('#save_button_parent').text('{{ __("common.updating") }}');
                resetValidationErrors()
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('frontendcms.subscribe-content.update') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                        $('#save_button_parent').text('{{__("common.update")}}');
                        $("#save_button_parent").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        showValidationErrors('#formData', response.responseJSON.errors);
                        $('#save_button_parent').text('{{__("common.update")}}');
                        $("#save_button_parent").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });


            function showValidationErrors(formType, errors) {
                $(formType + ' #title_error_{{auth()->user()->lang_code}}').text(errors['title.{{auth()->user()->lang_code}}']);
                $(formType + ' #subtitle_error_{{auth()->user()->lang_code}}').text(errors['subtitle.{{auth()->user()->lang_code}}']);
                $(formType + ' #slug_error').text(errors.slug);
                $(formType + ' #description_error').text(errors.description);
                $(formType + ' #file_error').text(errors.file);
            }


            function resetValidationErrors(){
                $('#formData' + ' #title_error_{{auth()->user()->lang_code}}').text('');
                $('#formData' + ' #subtitle_error_{{auth()->user()->lang_code}}').text('');
                $('#formData' + ' #slug_error').text('');
                $('#formData' + ' #description_error').text('');
                $('#formData' + ' #file_error').text('');
            }

            $(document).on('change', '#document_file_1', function(){
                getFileName($(this).val(),'#placeholderFileOneName');
                imageChangeWithFile($(this)[0],'#blogImgShow');
            });
        });
    })(jQuery);
</script>
@endpush
