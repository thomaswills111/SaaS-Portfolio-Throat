<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex flex-row">
                <h2 class="font-semibold
                            text-xl text-gray-800
                            dark:text-gray-200 leading-tight pr-10">
                    {{ __('DEFINITIONS') }}
                </h2>
            </div>

        </div>
    </x-slot>

    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The definition for {{ session()->get('created') }} was created successfully.
            </p>
        </div>
        @endif
    @if(session()->has('rated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The definition {{ session()->get('rated') }} was rated successfully.
            </p>
        </div>
        @endif
    @if(session()->has('unrated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-orange-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-orange-800 rounded-full mr-4 p-2"></i>
                The definition {{ session()->get('rated') }} was unrated successfully.
            </p>
        </div>
        @endif
    @if(session()->has('noRating'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The definition {{ session()->get('rated') }} was unrated successfully.
            </p>
        </div>
        @endif
    @if(session()->has('ratingCreated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The rating {{ session()->get('ratingCreated') }} was created successfully.
            </p>
        </div>
        @endif
    @if(session()->has('updated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-amber-500 text-white rounded">
                <i class="fa fa-check-circle text-amber-200 bg-amber-800 rounded-full mr-4 p-2"></i>
                The definition for {{ session()->get('updated') }} was updated successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The definition for {{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif

    {{--        table.table.w-full.text-gray-900.dark:text-gray-200--}}
    <table class="table w-full text-gray-900 dark:text-gray-200 text-left">
        <thread>
            <tr>
                <th>Row</th>
                <th>Word</th>
                <th>Word Type</th>
                <th>Definition</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thread>
        <tbody>
        @foreach($definitions as $definition)
            <tr>
                <td class="p-2">{{$loop->index + 1}}</td>
                <td class="p-2">{{$definition->word->word}}</td>
                <td class="p-2">{{$definition->wordType->name}}</td>
                <td class="p-2">{{$definition->definition}}</td>
                <td>
                    @if(count($definition->ratings) > 0)
                        @for($count=1; $count <= ($definition->ratings->avg('stars')/2); $count++)
                            <i class="fa fa-star"></i>
                        @endfor
                            ({{round($definition->ratings->avg('stars'), 2)/2}})
                    @else
                        <p>Unrated</p>
                    @endif
                </td>
{{--                <td class="p-2">{{$definition->ratings->avg('stars')}}</td>--}}
                <td class="p-2 flex flex-row">
                    <a href="{{ route('definitions.show',['definition'=>$definition]) }}"
                       class="text-center p-2 grow rounded-l-md bg-green-500 text-white
                   dark:bg-green-800 hover:bg-green-900 dark:hover:bg-green-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-eye"></i>
                        <span class="sr-only">View</span>
                    </a>
                    <a href="{{ route('definitions.rate', ['definition'=>$definition]) }}"
                       class="text-center p-2 grow bg-yellow-500 text-white
                   dark:bg-yellow-800 hover:bg-yellow-900 dark:hover:bg-yellow-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-star"></i>
                        <span class="sr-only">Rate</span>
                    </a>
                    <a href="{{route('definitions.edit', ['definition'=>$definition])}}"
                       class="text-center p-2 grow bg-orange-500 text-white
                   dark:bg-orange-800 hover:bg-orange-900 dark:hover:bg-orange-500
                   transition ease-in-out duration-350">
                        <i class="fa fa-pencil"></i>
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="{{route('definitions.delete', ['definition'=>$definition])}}"
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
                {{$definitions->links()}}

            </td>
        </tr>
        </tfoot>
    </table>
</x-app-layout>
