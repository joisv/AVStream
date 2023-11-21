<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <header>
        <h1 class="text-2xl font-semibold">Info message</h1>
    </header>
    <form wire:submit.prevent="save" class="py-4">
        <div class="md:w-[65%] w-full space-y-5">
            <div class="w-full">
              <div class="flex justify-between items-center py-1">
                <x-inputs.label-input for="summernote_info" class="text-gray-500">Info
                    message</x-inputs.label-input>
                    <livewire:dashboard.settings.info-visibility :is_info_active="$is_info_active"/>
              </div>
                <div wire:ignore class="prose prose-base lg:prose-lg prose-code:text-rose-500 prose-a:text-blue-600">
                    <div id="summernote_info" name="editordata"></div>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-end mt-4 md:mt-0">
            <x-primary-button wire:loading.attr="disabled" type="submit"
                custom="disabled:opacity-50 bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                <x-slot name="icon">
                    <x-icons.edit />
                </x-slot>
                <x-slot name="child">
                    save
                </x-slot>
            </x-primary-button>
        </div>
    </form>
    <script>
        window.addEventListener('livewire:load', function() {
            $('#summernote_info').summernote({
                placeholder: 'info message here...',
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
                        $('#summernote_info').summernote('code', @json($info));
                        $('.note-group-select-from-files').first().remove();
                    },
                    onChange: function(contents, $editable) {
                        @this.set('info', contents, true);
                    }
                }
            });
        })
    </script>
</div>

