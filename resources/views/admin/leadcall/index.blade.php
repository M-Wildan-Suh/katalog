<x-app-layout head="Leadcall" title="Admin - Leadcall">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <form action="{{ route('leadcall.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
                <div class=" w-full grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-admin.component.textinput title="No. Telephone" placeholder="Masukkan no. telephone" :value="old('no_tlp', $data->no_tlp ?? '')" name="no_tlp" />
                    <x-admin.component.textinput title="No. WhatsApp" placeholder="Masukkan no. WhatsApp" :value="old('no_wa', $data->no_wa ?? '')" name="no_wa" />
                    <x-admin.component.textinput title="Teks Tombol Telephone" placeholder="Masukkan teks tombol telephone" :value="old('tlp_button_text', $data->tlp_button_text)" name="tlp_button_text" />
                    <x-admin.component.textinput title="Teks Tombol WhatsApp" placeholder="Masukkan teks tombol whatsapp" :value="old('wa_button_text', $data->wa_button_text ?? '')" name="wa_button_text" />
                    <div class="w-full">
                        <div class="flex flex-col gap-2 text-sm sm:text-base font-medium">
                            <label for="tlp_color">Warna Tombol Telephone</label>
                            <div class=" w-full flex items-center justify-center overflow-hidden shadow-md shadow-black/20 rounded-md h-10">
                                <input type="color" name="tlp_color" id="tlp_color" class=" min-w-[105%] h-14 rounded-md cursor-pointer" value="{{old('tlp_color', $template->tlp_color ?? null) ?? '#de0301'}}">
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col gap-2 text-sm sm:text-base font-medium">
                            <label for="wa_color">Warna Tombol WhatsApp</label>
                            <div class=" w-full flex items-center justify-center overflow-hidden shadow-md shadow-black/20 rounded-md h-10">
                                <input type="color" name="wa_color" id="wa_color" class=" min-w-[105%] h-14 rounded-md cursor-pointer" value="{{old('wa_color', $template->wa_color ?? null) ?? '#de0301'}}">
                            </div>
                        </div>
                    </div>
                </div>
                <x-admin.component.submitbutton title="Save" />
            </div>
        </form>
    </div>

    @include('components.admin.component.validationerror')
</x-app-layout>
