<details class="tw-dw-dropdown tw-dw-dropdown-end" style="margin: 10px;">
    <summary class="tw-bg-transparent tw-text-gray-500 tw-font-medium tw-text-sm md:tw-text-base select-none" style="cursor:pointer; list-style:none;">
        {{ isset($_GET['lang']) ? config('constants.langs')[$_GET['lang']]['full_name'] : config('constants.langs')[config('app.locale')]['full_name'] }}
    </summary>
    <ul class="tw-p-2 tw-shadow tw-dw-menu tw-dw-dropdown-content tw-z-[1] tw-w-48 md:tw-w-56 tw-rounded-xl tw-mt-3"
        style="background:#fff; border:1px solid #e2e8f0; box-shadow:0 10px 30px -5px rgba(0,0,0,0.1);">
        @foreach (config('constants.langs') as $key => $val)
            <li><a value="{{ $key }}" class="change_lang" style="color:#475569; padding:8px 14px; border-radius:8px; display:block; text-decoration:none; cursor:pointer;">{{ $val['full_name'] }}</a></li>
        @endforeach
    </ul>
</details>
