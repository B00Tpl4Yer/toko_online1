@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-base  text-center text-white py-1 lg:py-2 mx-4 lg:mx-3 xl:mx-4 font-bold bg-gradient-to-bl from-gray-600 via-blue-500 to-gray-600
                                dark:bg-gradient-to-bl dark:from-blue-950 dark:via-gray-900 dark:to-blue-950 dark:border dark:border-gray-700 px-4 rounded-md hover:bg-blue-500'
            : 'text-base  text-center text-white py-1 lg:py-2 mx-4 lg:mx-3 xl:mx-4 font-bold bg-gradient-to-bl from-gray-600 via-blue-500 to-gray-600
                                dark:bg-gradient-to-bl dark:from-blue-950 dark:via-gray-900 dark:to-blue-950 dark:border dark:border-gray-700 px-4 rounded-md hover:bg-blue-500 w-full';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
