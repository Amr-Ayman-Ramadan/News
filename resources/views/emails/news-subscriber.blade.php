<x-mail::message>
    # Welcome to {{ config('app.name') }}!

    Thank you for subscribing to our newsletter! We're excited to have you on board and can't wait to share the latest updates, news, and exclusive content with you.

    <x-mail::panel>
        **Stay connected with us and never miss an update.**
        We promise to bring you the best of what we have to offer, directly to your inbox.
    </x-mail::panel>

    <x-mail::button :url="route('endUser.home')" color="success">
        Visit Our Website
    </x-mail::button>

    ---


    Thanks again for joining us!
    Warm regards,
    The {{ config('app.name') }} Team

    <x-mail::footer>
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </x-mail::footer>
</x-mail::message>
