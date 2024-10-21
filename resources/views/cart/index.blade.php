<x-app-layout>

    <h1 class="mb-4">Корзина</h1>

    <div class="flex gap-x-3 gap-y-5 flex-wrap">
        @if(count($cartItems))
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Товар</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Количество</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td class="px-2 py-1">{{ $cartItem->product->name }}</td>
                        <td class="px-2 py-1 text-right">{{ $cartItem->price }} $</td>
                        <td class="px-2 py-1 text-center">{{ $cartItem->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        <div class="w-full">
            <form action="">
                <x-primary-button class="py-4 mt-4">Оформить заказ</x-primary-button>
            </form>
        </div>
        @else
            <p>...увы пуста. Наполните её чем-то прекрасным</p>
        @endif
    </div>

</x-app-layout>