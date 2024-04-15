<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    use App\Models\Patient;
    use App\Models\PatientActivity;

    $data = PatientActivity::all();
    $user = [];
    foreach ($data as $key => $value) {

        $patient = Patient::find($value->patient_id);
        if ($patient->user_id == auth()->user()->id) {
            $value->patient_name = $patient->name;
            array_push($user, $value);
        }
    }
    ?>

    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>

    <table id="customers">
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
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $d->patient_name }}
                </td>
                <td class="px-6 py-4">
                    {{ $d->Activity }}
                </td>
                <td class="px-6 py-4">
                    {{ $d->date_time }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>