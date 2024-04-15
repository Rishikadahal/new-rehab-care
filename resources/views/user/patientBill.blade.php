@extends('user.layout.main')
@section('content')
<div class="flex items-center justify-between">
    <h1 class="p-5" style="font-size: 20px; font-weight:bold">Patient Activites</h1>
</div>


<div class="relative overflow-x-auto p-5">

    <div class="flex align-center justify-end my-3">
        <a href="{{ url('/generate-pdf') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-right">
            Generate PDF
        </a>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Patient
                </th>
                <th scope="col" class="px-6 py-3">
                    Particular
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>

                <th scope="col" class="px-6 py-3">
                    Bill Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $d)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$d->patient_id}}
                </th>
                <td class="px-6 py-4">
                    {{$d->particular}}

                </td>
                <td class="px-6 py-4">
                    {{$d->bill_amount}}

                </td>
                <td class="px-6 py-4">
                    @if($d->bill_status == '2')
                    <span class="badge bg-danger">Unpaid</span>
                    @else
                    <span class="badge bg-success">paid</span>
                    @endif
                </td>
                <td>
                    @if($d->bill_status == '2')
                    <button id="payment-button" data-bill-amount="{{$d->bill_amount}}" data-bill-id="{{$d->id}}" class="mt-3 btn text-white payment-btn" style="background-color: #5E338D;">Pay with Khalti</button>
                    @else
                    -
                    @endif
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<script>
    const btn = document.getElementById('download-pdf');
    const table = document.querySelector('table'); // Select the table element

    btn.addEventListener('click', function() {
        const doc = new jsPDF();
        const tableHtml = table.outerHTML; // Get the entire HTML of the table

        // Set document options (optional)
        doc.setFontSize(12); // Set font size

        // Add table to PDF
        doc.html(tableHtml, {
            callback: function(pdf) {
                pdf.save('patient_activities.pdf'); // Set the filename
            }
        });
    });
</script>

<script>
    var billId;

    var config = {
        // replace the publicKey with yours
        "publicKey": "test_public_key_b3a938dfe3a3482ea414c7ae08b0f0ac",
        "productIdentity": "['1234567890','2341243213]",
        "productName": "['Dragon','sarbanam']",
        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
        ],
        "eventHandler": {
            onSuccess(payload) {
                // hit merchant api for initiating verfication
                console.log(payload);
                axios.get(`/update-bill-status/` + billId)
                    .then(response => {
                        console.log(response.data.message);
                        // Optionally, you can perform additional actions after updating the order status
                        window.location.reload()
                    })
                    .catch(error => {
                        console.error(error);
                        // Handle errors if any
                    });


            },
            onError(error) {
                console.log(error);
            },
            onClose() {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var pay_btns = document.querySelectorAll(".payment-btn");
    pay_btns.forEach(function(pay_btn) {
        pay_btn.onclick = function() {
            var total = parseFloat(this.getAttribute("data-bill-amount")) * 100; // Convert to paisa
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            billId = this.getAttribute("data-bill-id");
            checkout.show({
                amount: total
            });
        };
    });
</script>



@endsection