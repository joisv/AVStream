<x-home-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <div class="min-h-screen sm:mb-[25vh] mb-[7vh] p-2 lg:p-0 max-w-4xl mx-auto">
        <section class="w-full h-44 p-3 flex justify-center items-end">
            <header class="w-[40%] text-center ">
                <h1
                    class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold text-2xl mb-3">
                    Contact Page
                </h1>
            </header>
        </section>
        <div class="rounded-md bg-gray-800 p-10">
            <div class="gap-8 justify-center">
                <div class="text-white flex flex-col items-center">
                    @forelse ($contacts as $contact)
                    <a href="{{ $contact->contact_url }}">
                        <h1 class="font-medium text-xl hover:text-rose-500">{{ $contact->name }}</h1>
                    </a>
                    @empty
                        <h1>No Contact</h1>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-home-layout>
