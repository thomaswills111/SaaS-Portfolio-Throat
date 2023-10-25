<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold
                            text-xl text-gray-800
                            dark:text-gray-200 leading-tight pr-10">
                {{ __('DEFINITIONS') }}
            </h2>
        </div>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800 dark:text-gray-200
                   font-bold">
            {{ __('Add') }}
        </h3>

        @if($errors->any())
            <div class="flex flex-col gap-4 bg-red-200 text-red-800 my-4 rounded-lg">
                @foreach($errors->all() as $error)
                    <p class="p-4">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('definitions.store') }}"
            class="flex flex-col w-full gap-4">

            @csrf
            @method('POST')

            @if($word)
                <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                    <label
                        for="Word"
                        class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                        {{ __("Word") }}
                    </label>
                    <input
                        id="Word"
                        name="word"
                        type="text"
                        class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md dark:text-gray-100"
                        readonly
                        value="{{$word->word}}"/>
                </div>
            @else
                <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                    <label
                        for="Word"
                        class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                        {{ __("Word") }}
                    </label>
                    <input
                        id="Word"
                        name="word"
                        type="text"
                        class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md dark:text-gray-100"
                        value="{{ old('word') }}"/>
                </div>
            @endif


            <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                <label
                    for="WordType"
                    class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                    {{ __("Word Type") }}
                </label>
                <input
                    id="WordType"
                    name="word_type"
                    type="text"
                    class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md dark:text-gray-100"
                    value="{{ old('wordType') }}"/>
            </div>

            <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                <label
                    for="Definition"
                    class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                    {{ __("Definition") }}
                </label>
                <textarea
                    id="Definition"
                    class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md dark:text-gray-100"
                    name="definition"
                    rows="2"
                >{{old('definition')}}</textarea>
            </div>


            <div class="flex flex-row rounded-md">

                <a href="{{ route('wordTypes.index') }}"
                   class="text-center p-2 grow rounded-l-md
                          text-white
                          bg-sky-500 hover:bg-sky-900
                          dark:bg-sky-800 dark:hover:bg-sky-500
                          transition ease-in-out duration-350">
                    <i class="fa fa-arrow-rotate-back"></i>
                    <span class="sr-only">Back</span>
                </a>

                <button
                    type="submit"
                    class="text-center p-2 grow
                       text-white rounded-r-md
                       bg-orange-500 hover:bg-orange-900
                       dark:bg-orange-800 dark:hover:bg-orange-500
                       transition ease-in-out duration-350">
                    <i class="fa fa-save"></i>
                    <span class="sr-only">Save</span>
                </button>

            </div>

        </form>

    </section>

</x-app-layout>
