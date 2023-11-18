<div>
    <button data-tooltip-target="tooltip-right" data-tooltip-placement="right" type="button" wire:click="visibiltyWarning">
        <x-icons.eye height="25px" width="25px" stroke="{{ $is_warning_active ? '#000000' : '#d1d5db' }}" />
    </button>
    <div id="tooltip-right" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Tooltip on right
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>
