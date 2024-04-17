<aside class="footer container text-center small pt-3 pb-5">
    @auth
        <div class="mt-1">
            @lang('linkace.version', ['version' => \App\Helper\UpdateHelper::currentVersion()]) -
            <x-update-check class="d-inline-block"/>
        </div>
    @endauth
</aside>
