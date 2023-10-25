<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold
                            text-xl text-gray-800
                            dark:text-gray-200 leading-tight pr-10">
                {{ __('RATINGS') }}
            </h2>
        </div>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800
        dark:text-gray-200 font-bold">
            Details
        </h3>
        <div class="flex flex-row gap-4 rounded-md
        bg-gray-200 dark:bg-gray-800">
            <p class="p-2 w-1/6 rounded-l-md
                     bg-gray-500 dark:bg-gray-800
                     text-gray-100 dark:text-gray-200">
                Name:
            </p>
            <p class="p-2 w-5/6 dark:text-gray-200">{{$rating->name}}</p>
        </div>

        <div class="flex flex-row gap-4 rounded-md
        bg-gray-200 dark:bg-gray-800">
            <p class="p-2 w-1/6 rounded-l-md
                     bg-gray-500 dark:bg-gray-800
                     text-gray-100 dark:text-gray-200">
                Icon:
            </p>
            <p class="p-2 w-5/6 dark:text-gray-200">{{$rating->icon}} (<i class="fa fa-{{$rating->icon}}"></i>)</p>
        </div>

        <div class="flex flex-row gap-4 rounded-md
        bg-gray-200 dark:bg-gray-800">
            <p class="p-2 w-1/6 rounded-l-md
                     bg-gray-500 dark:bg-gray-800
                     text-gray-100 dark:text-gray-200">
                Stars:
            </p>
            <p class="p-2 w-5/6 dark:text-gray-200">{{$rating->stars}}</p>
        </div>

        <div class="flex flex-row gap-4 rounded-md
        bg-gray-200 dark:bg-gray-800">
            <p class="p-2 w-1/6 rounded-l-md
                     bg-gray-500 dark:bg-gray-800
                     text-gray-100 dark:text-gray-200">
                Created At:
            </p>
            <p class="p-2 w-5/6 dark:text-gray-200">{{$rating->created_at}}</p>

        </div>

        <div class="flex flex-row gap-4 rounded-md
        bg-gray-200 dark:bg-gray-800">
            <p class="p-2 w-1/6 rounded-l-md
                     bg-gray-500 dark:bg-gray-800
                     text-gray-100 dark:text-gray-200">
                Updated At:
            </p>
            <p class="p-2 w-5/6 dark:text-gray-200">{{$rating->updated_at}}</p>
        </div>

        <p class="flex flex-row md:w-13 w-full rounded-md">
            <a href="{{route('ratings.index')}}"
               class="text-center p-2 grow rounded-l-md bg-sky-500 text-white
                   dark:bg-sky-800 hover:bg-sky-900 dark:hover:bg-sky-500
                   transition ease-in-out duration-350">
                <i class="fa fa-arrow-rotate-back"></i>
                <span class="sr-only">Back</span>
            </a>
            <a href="{{ route('ratings.edit', ['rating'=>$rating])}}"
               class="text-center p-2 grow bg-orange-500 text-white
                   dark:bg-orange-800 hover:bg-orange-900 dark:hover:bg-orange-500
                   transition ease-in-out duration-350">
                <i class="fa fa-edit"></i>
                <span class="sr-only">Edit</span>
            </a>
            <a href="{{route('ratings.destroy', ['rating'])}}"
               class="text-center p-2 grow rounded-r-md bg-red-500 text-white
                   dark:bg-red-800 hover:bg-red-900 dark:hover:bg-red-500
                   transition ease-in-out duration-350">
                <i class="fa fa-times"></i>
                <span class="sr-only">Delete</span>
            </a>
        </p>
    </section>
</x-app-layout>
