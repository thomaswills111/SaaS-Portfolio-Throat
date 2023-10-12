<x-guest-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex flex-row">
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
            <p class="text-gray-100">
                <a href="{{ route('wordTypes.create') }}"
                   class="rounded-lg p-2 bg-blue-900
                transition ease-in-out duration-500
                hover:bg-blue-100 hover:text-blue-900"
                >Add New Word Type</a>
            </p>
        </div>
    </x-slot>

    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The word type "{{ session()->get('created') }} was created successfully.
            </p>
        </div>
        @endif
    @if(session()->has('updated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-amber-500 text-white rounded">
                <i class="fa fa-check-circle text-amber-200 bg-amber-800 rounded-full mr-4 p-2"></i>
                The word type "{{ session()->get('updated') }} was updated successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The word type "{{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif

    {{--        table.table.w-full.text-gray-900.dark:text-gray-200--}}
    <table class="table w-full text-gray-900 dark:text-gray-200 text-left">
        <thread>
            <tr>
                <th>Row</th>
                <th>Name</th>
                <th>Code</th>
                <th>Actions</th>
            </tr>
        </thread>
        <tbody>
        @foreach($wordTypes as $wordType)
            <tr>
                <td class="p-2">{{$loop->index + 1}}</td>
                <td class="p-2">{{$wordType->name}}</td>
                <td class="p-2">{{$wordType->code}}</td>
                <td class="p-2 flex flex-row">
                    <a href="{{ route('wordTypes.show',['wordType'=>$wordType]) }}"
                       class="text-center p-2 grow rounded-l-md bg-green-500 text-white
                   dark:bg-green-800 hover:bg-green-900 dark:hover:bg-green-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-eye"></i>
                        <span class="sr-only">View</span>
                    </a>
                    <a href="{{route('wordTypes.edit', ['wordType'=>$wordType])}}"
                       class="text-center p-2 grow bg-orange-500 text-white
                   dark:bg-orange-800 hover:bg-orange-900 dark:hover:bg-orange-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-edit"></i>
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="{{route('wordTypes.delete', ['wordType'=>$wordType])}}"
                       class="text-center p-2 grow rounded-r-md bg-red-500 text-white
                   dark:bg-red-800 hover:bg-red-900 dark:hover:bg-red-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-times"></i>
                        <span class="sr-only">Delete</span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="p-2">
                {{$wordTypes->links()}}

            </td>
        </tr>
        </tfoot>
    </table>
</x-guest-layout>
