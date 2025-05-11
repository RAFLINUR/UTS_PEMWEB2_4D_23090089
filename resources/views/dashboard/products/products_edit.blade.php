<x-layouts.app :title="__('Categories')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Update Product Categories</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Product Categories</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{session()->get('successMessage')}}</flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 wf-full">{{session()->get('errorMessage')}}</flux:badge>
    @endif

    <form action="{{ route('products.update', $products->id) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        
        <flux:input label="Nama Produk" name="name" value="{{ $products->name }}" class="mb-3" />

        <flux:input label="Harga" name="price" value="{{ $products->price }}" class="mb-3" />

        <flux:input  label="Kategori" name="category" value="{{ $products->category_id}}" class="mb-3" />

        <flux:separator />




        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('products') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>