<x-app-layout>

    <h1 class="mb-4">Заказы</h1>

    <div class="flex gap-x-3 gap-y-5 flex-wrap">
        @if(count($orders))
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Номер</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Товары</th>
                    <th scope="col">Сумма</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="border-b border-gray-300">
                        <td class="px-2 py-1"># {{ $order->id }}</td>
                        <td class="px-2 py-1 text-center">{{ \Carbon\Carbon::create($order->created_at)->format('d.m.Y') }}</td>
                        <td class="px-2 py-1 text-right w-1/4 text-break italic">{{ $order->product_list }}</td>
                        <td class="px-2 py-1 text-right">{{ $order->amount }} $</td>
                        <td class="px-2 py-1 text-center">
                            <form action="{{ route('orders.destroy', $order) }}"
                                    method="POST">
                                @csrf
                                @method('DELETE')

                                <input hidden value="{{ $order->id }}">
                                <x-primary-button>Удалить заказ</x-primary-button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>...нет заказов. Это грустно</p>
        @endif
    </div>

</x-app-layout>
