<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex flex-row">
                <h2 class="font-semibold
                            text-xl text-gray-800
                            dark:text-gray-200 leading-tight pr-10">
                    {{ __('WORDS') }}
                </h2>
            </div>
            <p class="text-gray-100">
                <a href="{{ route('words.create') }}"
                   class="rounded-lg p-2 bg-blue-900
                transition ease-in-out duration-500
                hover:bg-blue-100 hover:text-blue-900"
                >Add New Word</a>
            </p>
        </div>
    </x-slot>

    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The word {{ session()->get('created') }} was created successfully.
            </p>
        </div>
        @endif
    @if(session()->has('updated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-amber-500 text-white rounded">
                <i class="fa fa-check-circle text-amber-200 bg-amber-800 rounded-full mr-4 p-2"></i>
                The word {{ session()->get('updated') }} was updated successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The word {{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif

    {{--        table.table.w-full.text-gray-900.dark:text-gray-200--}}
    <table class="table w-full text-gray-900 dark:text-gray-200 text-left">
        <thread>
            <tr>
                <th>Row</th>
                <th>Word</th>
                <th>Actions</th>
            </tr>
        </thread>
        <tbody>
        @foreach($words as $word)
            <tr>
                <td class="p-2">{{$loop->index + 1}}</td>
                <td class="p-2">{{$word->word}}</td>
                <td class="p-2 flex flex-row">
                    <a href="{{ route('words.show',['word'=>$word]) }}"
                       class="text-center p-2 grow rounded-l-md bg-green-500 text-white
                   dark:bg-green-800 hover:bg-green-900 dark:hover:bg-green-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-eye"></i>
                        <span class="sr-only">View</span>
                    </a>
                    <a href="{{route('definitionsWord.create', ['word'=>$word])}}"
                       class="text-center p-2 grow bg-yellow-500 text-white
                   dark:bg-yellow-800 hover:bg-orange-900 dark:hover:bg-yellow-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-plus"></i>
                        <span class="sr-only">Define</span>
                    </a>
                    <a href="{{route('words.edit', ['word'=>$word])}}"
                       class="text-center p-2 grow bg-orange-500 text-white
                   dark:bg-orange-800 hover:bg-orange-900 dark:hover:bg-orange-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-pencil"></i>
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="{{route('words.delete', ['word'=>$word])}}"
                       class="text-center p-2 grow rounded-r-md bg-red-500 text-white
                   dark:bg-red-800 hover:bg-red-900 dark:hover:bg-red-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-trash"></i>
                        <span class="sr-only">Delete</span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="p-2">
                {{$words->links()}}

            </td>
        </tr>
        </tfoot>
    </table>
</x-app-layout>
