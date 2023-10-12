<x-guest-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex flex-row w-1/2">
                <h2 class="font-semibold
                            text-xl text-gray-800
                            dark:text-gray-200 leading-tight pr-10">
                    {{ __('THROAT') }}
                </h2>
                <a class="text-gray-800 dark:text-gray-100 px-2" href=" {{route('words.index')}}">Words</a>
                <a class="text-gray-800 dark:text-gray-100 px-2" href="{{route('wordTypes.index')}}">Word Types</a>
                <a class="text-gray-800 dark:text-gray-100 px-2" href="{{route('definitions.index')}}">Definitions</a>
                <a class="text-gray-800 dark:text-gray-100  pl-2 pr-8" href="{{route('ratings.index')}}">Ratings</a>
            </div>
        </div>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800 dark:text-gray-200
                   font-bold">
            {{ __('Edit') }}
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
            action="{{ route('definitions.update', ['definition'=>$definition]) }}"
            class="flex flex-col w-full gap-4">

            @csrf
            @method('PUT')


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
                        class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md"
                        value="{{$definition->word->word}}"
                        readonly
                    />
                </div>

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
                    class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md"
                    value="{{$definition->wordType->name}}"/>
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
                    class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md"
                    name="definition"
                    rows="2"
                >{{$definition->definition}}</textarea>
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

</x-guest-layout>
