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
                    Activity
                </th>
                <th scope="col" class="px-6 py-3">
                    Date and Time
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach($user as $d)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$d->patient_name}}
                </th>
                <td class="px-6 py-4">
                    {{$d->Activity}}
                </td>
                <td class="px-6 py-4">
                    {{$d->date_time}}
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



@endsection