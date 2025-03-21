<!-- Back Button with Icon -->
<button onclick="window.history.back()"
    style="display: flex; align-items: center; background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer;">
    <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px; margin-right: 8px;" viewBox="0 0 20 20"
        fill="currentColor">
        <path fill-rule="evenodd"
            d="M10 18a1 1 0 01-.707-.293l-7-7a1 1 0 010-1.414l7-7a1 1 0 011.414 1.414L4.414 10H18a1 1 0 110 2H4.414l6.293 6.293A1 1 0 0110 18z"
            clip-rule="evenodd" />
    </svg>
    Back
</button>

<!-- Print Button -->
<div style="text-align: center; margin-top: 20px;">
    <button onclick="printInvoice()"
        style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer;">
        Print Invoice
    </button>
</div>

<!-- Invoice Container -->
<div id="invoice"
    style="max-width: 400px; margin: 30px auto; background: white; padding: 16px; border-radius: 8px; border: 1px solid #ddd; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">

    <h2 style="text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 16px;">Pharmacy Invoice</h2>

    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span style="font-weight: bold;">Order ID:</span>
        <span>#{{ $order->id }}</span>
    </div>

    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span style="font-weight: bold;">Date:</span>
        <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
    </div>

    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span style="font-weight: bold;">Cashier:</span>
        <span>{{ $order->user->name }}</span>
    </div>

    <!-- Table -->
    <table style="width: 100%; border-top: 1px solid #ddd; margin-top: 12px; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid #ddd; text-align: left;">
                <th style="padding: 8px;">Medicine</th>
                <th style="padding: 8px; text-align: center;">Qty</th>
                <th style="padding: 8px; text-align: right;">Price</th>
                <th style="padding: 8px; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $item)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 8px;">{{ $item->medicine->name }}</td>
                    <td style="padding: 8px; text-align: center;">{{ $item->quantity }}</td>
                    <td style="padding: 8px; text-align: right;">${{ number_format($item->price, 2) }}</td>
                    <td style="padding: 8px; text-align: right;">${{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div
        style="display: flex; justify-content: space-between; border-top: 1px solid #ddd; margin-top: 12px; padding-top: 8px; font-weight: bold;">
        <span>Total Amount:</span>
        <span>${{ number_format($orderItems->sum('total'), 2) }}</span>
    </div>

    <!-- QR Code Section -->
    <div style="margin-top: 16px; text-align: center;">
        <h3 style="font-weight: bold; margin-bottom: 8px;">Order QR Code</h3>
        @if (!empty($qrBase64))
            <img src="{{ $qrBase64 }}" alt="QR Code"
                style="display: block; margin: 0 auto; width: 150px; height: 150px;">
        @else
            <p style="color: red; font-size: 12px;">QR code not available.</p>
        @endif
    </div>

    <p style="text-align: center; font-size: 14px; margin-top: 12px; font-weight: bold;">Thank you for your purchase!
    </p>
</div>

<!-- JavaScript for Print Functionality -->
<script>
    function printInvoice() {
        window.print();
    }
</script>

<!-- Print-specific Styles -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #invoice,
        #invoice * {
            visibility: visible;
        }

        #invoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            max-width: 100%;
            box-shadow: none;
            border: none;
        }

        button {
            display: none;
        }
    }
</style>
