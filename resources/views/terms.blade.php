<x-home-layout>
    <div class="min-h-screen sm:mb-[25vh] mb-[7vh] p-2 lg:p-0 max-w-4xl mx-auto">
        <section class="w-full h-44 p-3 flex justify-center items-end">
            <header class="w-[40%] text-center ">
            </header>
        </section>
        <div class="rounded-md bg-gray-800 p-10">
            <div class="gap-8 justify-center">
                <div class="text-white">
                    @empty(!$terms)
                        <article
                            class="prose prose-base lg:prose-lg prose-code:text-rose-500 prose-a:text-blue-600 prose-headings:text-gray-200">

                            {!! $terms !!}
                        </article>
                    @endempty
                </div>
            </div>
        </div>

    </div>

</x-home-layout>
