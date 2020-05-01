<x-dashboard-tile
    :position="$position"
    :refresh-interval="$refreshIntervalInSeconds"
>
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div
            class="flex items-center justify-center"
        >
            <h1 class="text-3xl leading-none -mt-1">Google Fit</h1>
        </div>

        <div class="grid gap-padding" style="height: calc(100% - 13px);">
            <div class="flex flex-col items-center justify-center">
                <div class="flex items-center w-full flex-col flex-1 justify-center">
                    <svg class="w-6 h-6" fill="#fff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g>
                            <g id="icon-shape">
                                <path d="M11,7 L12.4428885,9.16433275 C12.7547607,9.63214111 13.4519098,10 14.0093689,10 L17,10 L17,8 L14,8 L12.5571115,5.83566725 C12.2452393,5.36785889 11.625859,4.75057268 11.1643327,4.4428885 L9.83566725,3.5571115 C9.36785889,3.24523926 8.61517502,3.23089499 8.14046936,3.51571839 L4,6 L4,11 L6,11 L6,7 L8,6 L5,20 L7,20 L9.35294118,12.3529412 L11,14 L11,20 L13,20 L13,12 L10.2941176,9.29411765 L11,7 Z M12,4 C13.1045695,4 14,3.1045695 14,2 C14,0.8954305 13.1045695,0 12,0 C10.8954305,0 10,0.8954305 10,2 C10,3.1045695 10.8954305,4 12,4 L12,4 Z" id="Combined-Shape"></path>
                            </g>
                        </g>
                    </svg>
                    <span class="text-4xl">{{ $stepCount }} <span class="text-dimmed">steps today</span></span>
                </div>
                <div class="flex items-center w-full flex-col flex-1 justify-center">
                    <svg class="w-6 h-6" fill="#fff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g>
                            <g id="icon-shape">
                                <path d="M2,12 L2,2 L0,2 L0,18 L2,18 L2,16 L18,16 L18,18 L20,18 L20,15 L20,12 L2,12 Z M10,6 L18.000385,6 C19.1047419,6 20,6.8938998 20,8.0048815 L20,11 L10,11 L10,6 Z M6,11 C7.65685425,11 9,9.65685425 9,8 C9,6.34314575 7.65685425,5 6,5 C4.34314575,5 3,6.34314575 3,8 C3,9.65685425 4.34314575,11 6,11 Z" id="Combined-Shape"></path>
                            </g>
                        </g>
                    </svg>
                    <span class="text-4xl">{{ $sleep }} <span class="text-dimmed">hours sleep last night</span></span>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-tile>
