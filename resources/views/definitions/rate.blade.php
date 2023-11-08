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
            {{ __('Choose a rating') }}
        </h3>

        @if($errors->any())
            <div class="flex flex-col gap-4 bg-red-200 text-red-800 my-4 rounded-lg">
                @foreach($errors->all() as $error)
                    <p class="p-4">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <table class="table w-full text-gray-900 dark:text-gray-200 text-left">
            <thread>
                <tr>
                    <th>Name</th>
                    <th>Stars</th>
                    <th>Rate</th>
                </tr>
            </thread>
            <tbody>
                <tr>
                    <td class="p-2">Unrate</td>
                    <td class="p-2"></td>
                    <td class="p-2 flex flex-row">
                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST" action="{{route('definitionRating.remove', ['definition'=>$definition])}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Unrate</button>
                        </form>
                    </td>
                </tr>
            @foreach($ratings as $rating)
                <tr>
                    <td class="p-2">{{$rating->name}}</td>
                    <td class="p-2">
                        @for($count=1; $count <= $rating->stars/2; $count++)
                            <i class="fa fa-{{$rating->icon}}"></i>
                        @endfor
                        ({{$rating->stars/2}})
                    </td>
                    <td class="p-2 flex flex-row">
                        <form class="px-4 py-2 bg-yellow-500 hover:bg-red-700 text-white rounded-md" method="POST" action="{{ route('definitionRating.store', ['definition'=>$definition, 'rating'=>$rating]) }}">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                    value="{{$rating->id}}">Select</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4" class="p-2">
                </td>
            </tr>
            </tfoot>
        </table>
    </section>

</x-app-layout>
