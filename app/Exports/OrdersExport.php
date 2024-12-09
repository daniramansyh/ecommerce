<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;



class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::all();
    }
    public function headings(): array
    {
        return [
            'Order Number',
            'Name',
            'Product',
            'Quantity',
            'Address',
            'Price',
            'Payment Method',
            'Shipping Method',
            'Total Price',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
    public function map($order): array
    {
        return [
            $order->order_number,
            $order->user->name,
            $order->product->name,
            $order->quantity,
            $order->address,
            $order->price,
            $order->payment_method,
            $order->shipping_method,
            $order->total_price=>number_format(($order->total_price*$order->quantity), 0, ',', '.'),
            $order->status,
            $order->created_at,
            $order->updated_at,
        ];
    }
}
