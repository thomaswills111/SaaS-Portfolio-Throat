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

        @if($errors->any())
            <div class="flex flex-col gap-4 bg-red-200 text-red-800 my-4 rounded-lg">
                @foreach($errors->all() as $error)
                    <p class="p-4">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h3 class="text-lg text-gray-800 dark:text-gray-200
                   font-bold">
            {{ __('Add') }}
        </h3>
        <form
            method="POST"
            action="{{ route('ratings.store') }}"
            class="flex flex-col w-full gap-4">

            @csrf
            @method('POST')

            <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                <label
                    for="Name"
                    class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                    {{ __("Name") }}
                </label>
                <input
                    id="Name"
                    name="name"
                    type="text"
                    class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md dark:text-gray-100"
                    value="{{ old('name')}}"/>
            </div>

            <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                <label for="Icon"
                       class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100 ">
                    {{ __('Icon') }}
                </label>
                <select
                    id="Icon"
                    name="icon"
                    class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md dark:text-gray-100">
                    <option value="lemon" @if(old('icon')=='lemon') selected @endif>Lemon</option>
                    <option value="star" @if(old('icon')=='star') selected @endif>Star</option>
                    <option value="splotch" @if(old('icon')=='splotch') selected @endif>Splotch</option>
                    <option value="poo" @if(old('icon')=='poo') selected @endif>Poo</option>
                    <option value="cloud" @if(old('icon')=='cloud') selected @endif>Cloud</option>
                    <option value="ghost" @if(old('icon')=='ghost') selected @endif>Ghost</option>
                    <option value="thumbs-up" @if(old('icon')=='thumbs-up') selected @endif>Thumbs Up
                    </option>
                    <option value="thumbs-down" @if(old('icon')=='thumbs-down') selected @endif>Thumbs
                        Down
                    </option>
                    <option value="" @if(old('icon')=='') selected @endif disabled>Select an icon
                    </option>
                </select>
            </div>

            <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                <label
                    for=Stars"
                    class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                    {{__('Stars')}}
                </label>
                <input type="range"
                       id="Stars"
                       name="stars"
                       class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md"
                       min="0" max="10" value="{{ old('stars')}}">
            </div>

            <div class="flex flex-row rounded-md">

                <a href="{{ route('definitions.index') }}"
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
