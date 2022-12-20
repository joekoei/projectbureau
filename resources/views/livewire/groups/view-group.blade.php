<div>
    {{-- list users from group --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                   {{-- add message --}}
                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg " role="alert">
                        <p class="font-bold">Succes!</p>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
                <div class="flex justify-between">

                    <h3 class="text-2xl font-bold my-2">Leden</h3>
                    {{-- add button --}}
                    <div class="flex justify-end">
                        <div>
                        <div class="flex py-4">
                            <input wire:model="userSearch" placeholder="student email" type="email" name="floating_email" id="floating_email" class="block px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <button wire:click="addUser" type="button" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-500">Lid toevoegen</button>
                        </div>
                         {{--message  --}}
                        @if (session()->has('user-add-error'))
                            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                                <p class="font-bold">Let op:</p>
                                <p>{{ session('user-add-error') }}</p>
                            </div>
                        @endif
                        </div>

                    </div>
                </div>

                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Naam
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acties
                                </th>

                            </tr>
                        </thead>
                       <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($group->users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items">
                                            {{$user->name}}
                                        </div>
                                    </td>
                                       <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items">
                                            {{$user->email}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items">
                                            {{-- delete button --}}
                                            <button wire:click="deleteUser({{$user->id}})" type="button" class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Verwijderen</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>

                <h3 class="text-2xl font-bold my-4">Projecten</h3>
                <ul class="w-48 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
                    @forelse($group->projects as $project)
                    <li class="py-2 px-4 w-full rounded-t-lg border-b border-gray-200">
                        <a href="{{route('projects.show', $project)}}">{{$project->name}}</a>
                    </li>
                    @empty
                    <li class="py-2 px-4 w-full rounded-t-lg border-b border-gray-200">Geen projecten</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

</div>
