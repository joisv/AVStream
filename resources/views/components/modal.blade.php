<div class="absolute w-screen min-h-screen backdrop-blur-sm z-30 flex justify-center" x-data
    @click="$store.modal.on = false">
    <div class="w-[90%] sm:max-w-sm h-fit mt-20 p-2" @click.stop>
       {{ $slot }}
    </div>
</div>
