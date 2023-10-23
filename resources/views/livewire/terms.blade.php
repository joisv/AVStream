<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <header>
            <h1 class="text-2xl font-semibold mb-4">Terms</h1>
        </header>
        <form wire:submit.prevent="save">
            <div wire:ignore class="prose prose-base lg:prose-lg prose-code:text-rose-500 prose-a:text-blue-600">
                <div id="summernote" name="editordata"></div>
            </div>
            <div class="w-full flex justify-end mt-4">
                @can('create')
                    <x-primary-button wire:loading.attr="disabled" type="submit"
                        custom="disabled:opacity-50 bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                        <x-slot name="icon">
                            <x-icons.edit />
                        </x-slot>
                        <x-slot name="child">
                            save
                        </x-slot>
                    </x-primary-button>
                @endcan
            </div>
        </form>
    </div>
    @error('terms')
        <div class="error">
            {{ $message }}
        </div>
    @enderror
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'terms here...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function() {
                        $('#summernote').summernote('code', @json($terms));
                        $('.note-group-select-from-files').first().remove();
                    },
                    onChange: function(contents, $editable) {
                        @this.set('terms', contents);
                    }
                }
            });

        });
    </script>
</div>
