@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-base-100 dark:text-gray-300 focus:border-accent dark:focus:border-accent focus:ring-accent dark:focus:ring-accent rounded-md shadow-sm']) !!}>
