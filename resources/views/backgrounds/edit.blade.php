<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit History') }}
            </h2>
            <Link href=" {{ route('backgrounds.index')}}" class="px-4 py-2 bg-slate-400 hover:bg-slate-600 text-slate-100 rounded-md flex ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                  </svg>
                Back
            </Link>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-splade-form :default="$background" method="PUT" :action="route('backgrounds.update',$background->id)" class="p-4 bg-white rounded-md" >
                <x-splade-input name="title" label="Title" />
                <x-splade-wysiwyg name="description" class="mt-4 mb-2" label="Description" />
                <x-splade-file name="image"  label="Image"  :show-filename="true" />
                <x-splade-submit class="mt-2" />
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
