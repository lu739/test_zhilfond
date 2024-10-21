<x-app-layout>

    <div class="flex gap-x-3 gap-y-5 flex-wrap">
        @foreach($products as $product)
            <x-product-card :product="$product"/>
        @endforeach
    </div>

</x-app-layout>
