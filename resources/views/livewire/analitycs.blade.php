<div class="space-y-3" x-data="{

    activeTab: $persist('views'),

    setActiveTab(tab) {

        this.activeTab = tab

    }
}">
    <div class="md:grid md:grid-cols-4 md:gap-3 space-y-3 md:space-y-0">
        <button @click.prevent="setActiveTab('users')" :class="{ 'ring-4 ring-gray-900': activeTab === 'users' }"
            class="inline-block rounded-sm text-sm font-medium w-full">
            <x-analitycs-card>
                <x-slot name="icon">
                    <x-icons.users width="45px" height="45px" />
                </x-slot>
                <x-slot name="title">
                    Today User
                </x-slot>
                <x-slot name="value">
                    {{ $newUserCount }}
                </x-slot>
            </x-analitycs-card>
        </button>
        <button @click.prevent="setActiveTab('revenue')" :class="{ 'ring-4 ring-emerald-600': activeTab === 'revenue' }"
            class="inline-block rounded-sm text-sm font-medium w-full">
            <x-analitycs-card bgIcon="bg-emerald-600">
                <x-slot name="icon">
                    <x-icons.money width="45px" height="45px" />
                </x-slot>
                <x-slot name="title">
                    Today Revenue
                </x-slot>
                <x-slot name="value">
                    {{ $todayRevenues }}
                </x-slot>
            </x-analitycs-card>
        </button>
        <button @click.prevent="setActiveTab('views')" :class="{ 'ring-4 ring-rose-400': activeTab === 'views' }"
            class="inline-block rounded-sm text-sm font-medium w-full">
            <x-analitycs-card bgIcon="bg-rose-500">
                <x-slot name="icon">
                    <x-icons.eye width="45px" height="45px" />
                </x-slot>
                <x-slot name="title">
                    Today Views
                </x-slot>
                <x-slot name="value">
                    {{ $todayViews }}
                </x-slot>
            </x-analitycs-card>
        </button>
        <button type="button" @click.prevent="setActiveTab('conversion')"
            :class="{ 'ring-4 ring-gray-800': activeTab === 'conversion' }"
            class="inline-block rounded-sm text-sm font-medium w-full">
            <x-analitycs-card>
                <x-slot name="icon">
                    <x-icons.percentage width="45px" height="45px" />
                </x-slot>
                <x-slot name="title">
                    Conversion rate
                </x-slot>
                <x-slot name="value">
                    {{ $todayConversion }} %
                </x-slot>
            </x-analitycs-card>
        </button>
    </div>
    <div class="w-full lg:flex lg:space-x-2 space-y-3 lg:space-y-0">
        <div class="lg:w-[70%] w-full bg-white p-2">
            <div class="content min-h-[40vh]">
                <div x-cloak x-show="activeTab === 'views'">
                    <livewire:analitycs.views />
                </div>
                <div x-cloak x-show="activeTab === 'users'">
                    <livewire:analitycs.user />
                </div>
                <div x-cloak x-show="activeTab === 'revenue'">
                    <livewire:analitycs.revenue />
                </div>
                <div x-cloak x-show="activeTab === 'conversion'">
                    <livewire:analitycs.conversion />
                    {{-- halo conversion --}}
                </div>
            </div>

        </div>
        <div class="lg:w-[30%] w-full bg-gray-900 p-2 text-gray-100 max-h-[70vh] overflow-y-auto">
            <livewire:analitycs.most-watched />
        </div>
    </div>

</div>
