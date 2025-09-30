@foreach ($data as $item)
    <tr
        class="{{ $data->currentPage() == 1 ? ($loop->even ? 'bg-neutral-100' : 'bg-neutral-200') : ($loop->even ? 'bg-neutral-200' : 'bg-neutral-100') }} h-10 text-neutral-600 divide-x-2 divide-white">
        <td class="px-3 py-1 text-center font-semibold">
            {{ $loop->iteration + ($data->currentPage() == 1 ? 0 : 1) + ($data->currentPage() - 1) * 20 }}</td>
        <td class="px-2 sm:px-4 py-1 min-h-10 font-semibold break-all">{{ $item->category }}</td>
        <td class="px-2 sm:px-4 py-1 min-h-10 text-nowrap text-center">{{ $item->uniquecount }}</td>
        <td class="px-1 sm:px-2">
            <div class="flex gap-1 sm:gap-2 items-center justify-center">
                <div x-data="{ editmodal: false }" class=" w-5 h-5">
                    <button @click="editmodal = !editmodal" class="w-5 h-5 hover:text-green-500 duration-300">
                        <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 17.75A3.25 3.25 0 0 0 6.25 21h4.915l.356-1.423c.162-.648.497-1.24.97-1.712l5.902-5.903a3.279 3.279 0 0 1 2.607-.95V6.25A3.25 3.25 0 0 0 17.75 3H11v4.75A3.25 3.25 0 0 1 7.75 11H3v6.75ZM9.5 3.44 3.44 9.5h4.31A1.75 1.75 0 0 0 9.5 7.75V3.44Zm9.6 9.23-5.903 5.902a2.686 2.686 0 0 0-.706 1.247l-.458 1.831a1.087 1.087 0 0 0 1.319 1.318l1.83-.457a2.685 2.685 0 0 0 1.248-.707l5.902-5.902A2.286 2.286 0 0 0 19.1 12.67Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>
                    <div x-show="editmodal"
                        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                        <div
                            class="w-full max-w-[720px] bg-white pb-6 rounded-md flex flex-col gap-4 relative overflow-hidden border-2 border-byolink-1">
                            <button @click="editmodal = false"
                                class=" absolute top-6 right-6 w-6 h-6 text-white hover:text-red-500 duration-300">
                                <svg viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 512 512">
                                    <path
                                        d="M437.5 386.6 306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"
                                        fill="currentColor" class="fill-000000"></path>
                                </svg>
                            </button>
                            <div class=" pt-6 pb-3 bg-byolink-1 text-white">
                                <h2 class=" px-6 text-2xl font-bold">Ganti Kategori</h2>
                            </div>
                            <form action="{{ route('category.update', ['category' => $item->id]) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('put')
                                <div class="space-y-4 px-6 text-black">
                                    <x-admin.component.textinput title="Kategori" placeholder="Masukkan Kategori"
                                        :value="old('category', $item->category)" name="category" />
                                    <x-admin.component.submitbutton title="Edit Kategori" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Delete --}}
                <div x-data="{ deletemodal: false }" class=" w-5 h-5">
                    <button @click="deletemodal = !deletemodal"
                        class=" w-4 sm:w-5 aspect-square hover:text-red-500 duration-300">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.5 8.99h-15a.5.5 0 0 0-.5.5v12.5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9.49a.5.5 0 0 0-.5-.5Zm-9.25 11.5a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0Zm5 0a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0ZM20.922 4.851a11.806 11.806 0 0 0-4.12-1.07 4.945 4.945 0 0 0-9.607 0A12.157 12.157 0 0 0 3.18 4.805 1.943 1.943 0 0 0 2 6.476 1 1 0 0 0 3 7.49h18a1 1 0 0 0 1-.985 1.874 1.874 0 0 0-1.078-1.654ZM11.976 2.01A2.886 2.886 0 0 1 14.6 3.579a44.676 44.676 0 0 0-5.2 0 2.834 2.834 0 0 1 2.576-1.569Z"
                                fill="currentColor" class="fill-000000"></path>
                        </svg>
                    </button>
                    <x-admin.component.deletemodal :title="$item->url" :route="route('category.destroy', ['category' => $item->id])" />
                </div>
            </div>
        </td>
    </tr>
@endforeach
