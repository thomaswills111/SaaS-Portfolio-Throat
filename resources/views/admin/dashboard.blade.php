<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session()->has('updated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-amber-500 text-white rounded">
                <i class="fa fa-check-circle text-amber-200 bg-amber-800 rounded-full mr-4 p-2"></i>
                The user {{ session()->get('updated') }} was updated successfully.
            </p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @role('admin')
                    <table class="table w-full text-gray-900 dark:text-gray-200 text-left">
                        <thread>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Current Role</th>
                                <th>New Role</th>
                                <th>Action</th>
                            </tr>
                        </thread>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <form
                                    method="POST"
                                    action="{{ route('admin.updateRole', ['user'=>$user]) }}"
                                    class="flex flex-col w-full gap-4">

                                    @csrf
                                    @method('PATCH')
                                <td class="p-2">{{$user->id}}</td>
                                <td class="p-2">{{$user->name}}</td>
                                <td class="p-2">{{$user->email}}</td>
                                <td class="p-2">{{$user->getRoleNames()[0]}}</td>
                                <td class="p-4">
                                    <select
                                        id="Role"
                                        name="role"
                                        class="p-2 w-5/6 bg-gray-200 dark:bg-gray-100 rounded-md text-gray-900">
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    <td>
                                        <button
                                            type="submit"
                                            class="text-center p-2 grow
                                                text-white rounded-md
                                                bg-green-500 hover:bg-green-900
                                                dark:bg-green-800 dark:hover:bg-green-500
                                                transition ease-in-out duration-350">
                                            <i class="fa fa-save"></i>
                                            <span class="sr-only">Update</span>
                                        </button>
                                    </td>

                                </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" class="p-2">
                                {{$users->links()}}

                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    @endrole
            </div>
        </div>
    </div>
</x-app-layout>
