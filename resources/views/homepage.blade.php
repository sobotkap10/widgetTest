<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wally’s Widget</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body id="app" class="antialiased">
        <div class="container mx-auto py-10">

            <h1 class="text-2xl mb-10 font-medium">Welcome in Wally’s Widget Company.</h1>

            <h2 class="text-xl font-medium mb-2">Available Packs:</h2>

            <ul class="list-disc list-inside">
                @foreach (Config::get('deliveyGenerator.avaliablePackSizes') as $size)
                    <li>{{ $size }} widgets</li>
                @endforeach
            </ul>
            
            <sending-form></sending-form>

        </div>
    </body>
</html>
