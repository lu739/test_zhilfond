@props(['product'])

<div class="card p-3 bg-white rounded-lg" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title text-lg font-bold pb-2">{{ $product->name }}</h5>
        <div class="card-text text-2xl ml-auto pb-1">{{ $product->price }} $</div>
        <div class="flex gap-2">
            <input class="w-1/2 px-2 py-2 border border-gray-200 text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none"
                   name="quantity" value="1"/>
            <x-primary-button>Добавить в корзину</x-primary-button>
        </div>
{{--        <a href="#" class="btn btn-primary" role="button">Add to cart</a>--}}
    </div>
</div>
