<x-mail::message>

        # {{ $data['name'] }}

        # {{ $data['email'] }}

        # {{ $data['subject'] }}

        {{ $data['body'] }}

        {{--<x-mail::button :url="''">
            Button Text
        </x-mail::button>--}}

        <!--Thanks,<br>-->
        {{ config('app.name') }}
</x-mail::message>
