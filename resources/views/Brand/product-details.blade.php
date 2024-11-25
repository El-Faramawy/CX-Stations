<table style="width: 100%; text-align: center;">
    <thead>
    <tr>
        <th>اسم المنتج</th>
        <th>السعر</th>
        <th>الصورة</th>
        <th>رابط المنتج</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $cart_pro)
        <tr>
            <!-- Product Name -->
            <td>{{ $cart_pro->name ?? 'اسم غير متوفر' }}</td>

            <!-- Product Price -->
            <td>{{ $cart_pro->taxed_price['amount'] ?? 0 }} {{ $cart_pro->taxed_price['currency'] ?? 'SAR' }}</td>

            <!-- Product Thumbnail -->
            <td>
                <img src="{{ ($cart_pro->main_image == "" ) ? asset('Brand/assets/images/shopping-cart.png') :  $cart_pro->main_image}}"
                     alt="صورة المنتج"
                     style="width: 80px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
            </td>

            <!-- Product URL -->
            <td>
                <a href="{{ $cart_pro->urls['customer'] ?? '#' }}" target="_blank">
                    عرض المنتج
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
