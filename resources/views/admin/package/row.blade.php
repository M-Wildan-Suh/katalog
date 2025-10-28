@foreach ($data as $item)
    <tr class="{{ $loop->even ? 'bg-neutral-100' : 'bg-neutral-200' }} h-10 text-neutral-600 divide-x-2 divide-white">
        <td class="px-3 py-1 text-center font-semibold">{{ $loop->iteration }}</td>
        <td class="px-3 py-1 text-center text-nowrap">{{ $item->title }}</td>
        <td class="px-3 py-1 text-center text-nowrap">Rp.
            {{ $item->price >= 1000000 ? number_format($item->price / 1000000, 1, ',', '.') . ' JT' : ($item->price >= 1000 ? number_format($item->price / 1000, 0, ',', '.') . ' K' : number_format($item->price, 0, ',', '.')) }}
        </td>
        <td class="px-3 py-1 text-left text-nowrap hidden md:table-cell">
            <ul class=" list-disc pl-4">
                @foreach ($item->packageitem as $pitem)
                    <li class="">
                        <div class=" flex items-center justify-between gap-1">
                            <p>{{ $pitem->title }}</p>
                            <a href="{{ $pitem->video }}" class=" flex w-4 h-4 {{$pitem->video ? 'hover:text-blue-500' : 'pointer-events-none text-red-400'}}" target="_blank" >
                                <svg class=" w-full h-full" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M19,14 L19,19 C19,20.1045695 18.1045695,21 17,21 L5,21 C3.8954305,21 3,20.1045695 3,19 L3,7 C3,5.8954305 3.8954305,5 5,5 L10,5 L10,7 L5,7 L5,19 L17,19 L17,14 L19,14 Z M18.9971001,6.41421356 L11.7042068,13.7071068 L10.2899933,12.2928932 L17.5828865,5 L12.9971001,5 L12.9971001,3 L20.9971001,3 L20.9971001,11 L18.9971001,11 L18.9971001,6.41421356 Z"
                                        fill-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </td>
        <td class="px-3 py-1 text-center text-nowrap">
            <div class=" w-full flex items-center justify-center">
                <a href="{{ $item->video }}" class=" flex w-5 h-5 {{$item->video ? 'hover:text-blue-500' : 'pointer-events-none text-red-400'}}" target="_blank">
                    <svg class=" w-full h-full" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor"
                            d="M19,14 L19,19 C19,20.1045695 18.1045695,21 17,21 L5,21 C3.8954305,21 3,20.1045695 3,19 L3,7 C3,5.8954305 3.8954305,5 5,5 L10,5 L10,7 L5,7 L5,19 L17,19 L17,14 L19,14 Z M18.9971001,6.41421356 L11.7042068,13.7071068 L10.2899933,12.2928932 L17.5828865,5 L12.9971001,5 L12.9971001,3 L20.9971001,3 L20.9971001,11 L18.9971001,11 L18.9971001,6.41421356 Z"
                            fill-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </td>
        <td class="px-1 sm:px-2">
            <div class="flex gap-1 sm:gap-2 justify-center">
                {{-- Edit --}}
                <a href="{{ route('package.show', ['package' => $item->id]) }}"
                    class="w-5 h-5 hover:text-green-500 duration-300">
                    <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 17.75A3.25 3.25 0 0 0 6.25 21h4.915l.356-1.423c.162-.648.497-1.24.97-1.712l5.902-5.903a3.279 3.279 0 0 1 2.607-.95V6.25A3.25 3.25 0 0 0 17.75 3H11v4.75A3.25 3.25 0 0 1 7.75 11H3v6.75ZM9.5 3.44 3.44 9.5h4.31A1.75 1.75 0 0 0 9.5 7.75V3.44Zm9.6 9.23-5.903 5.902a2.686 2.686 0 0 0-.706 1.247l-.458 1.831a1.087 1.087 0 0 0 1.319 1.318l1.83-.457a2.685 2.685 0 0 0 1.248-.707l5.902-5.902A2.286 2.286 0 0 0 19.1 12.67Z"
                            fill="currentColor"></path>
                    </svg>
                </a>

                {{-- Delete --}}
                <div x-data="{ deletemodal: false }">
                    <button @click="deletemodal = !deletemodal"
                        class=" w-4 sm:w-5 aspect-square hover:text-red-500 duration-300">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.5 8.99h-15a.5.5 0 0 0-.5.5v12.5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9.49a.5.5 0 0 0-.5-.5Zm-9.25 11.5a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0Zm5 0a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0ZM20.922 4.851a11.806 11.806 0 0 0-4.12-1.07 4.945 4.945 0 0 0-9.607 0A12.157 12.157 0 0 0 3.18 4.805 1.943 1.943 0 0 0 2 6.476 1 1 0 0 0 3 7.49h18a1 1 0 0 0 1-.985 1.874 1.874 0 0 0-1.078-1.654ZM11.976 2.01A2.886 2.886 0 0 1 14.6 3.579a44.676 44.676 0 0 0-5.2 0 2.834 2.834 0 0 1 2.576-1.569Z"
                                fill="currentColor" class="fill-000000"></path>
                        </svg>
                    </button>
                    <x-admin.component.deletemodal :title="$item->title" :route="route('package.destroy', ['package' => $item->id])" />
                </div>
            </div>
        </td>
    </tr>
@endforeach
