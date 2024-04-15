@extends('user.layout.main')
@section('content')
<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<div class="flex items-center justify-between">
    <h1 class="p-5" style="font-size: 20px; font-weight:bold">Pre-Admit Concerns</h1>
    <a href="/add-pre-admit-concern" class=" mr-5"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button></a>
</div>


<div class="relative overflow-x-auto p-5">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Age
                </th>
                <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Medications
                </th>
                <th scope="col" class="px-6 py-3">
                    Past Illness
                </th>
                <th scope="col" class="px-6 py-3">
                    Details
                </th>
                <th scope="col" class="px-6 py-3">
                    Current Health
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$d->name}}
                </th>
                <td class="px-6 py-4">
                    {{$d->age}}
                </td>
                <td class="px-6 py-4">
                    {{$d->gender}}
                </td>
                <td class="px-6 py-4">
                    {{$d->medications}}
                </td>
                <td class="px-6 py-4">
                    {{$d->past_illness}}
                </td>
                <td class="px-6 py-4">
                    {{$d->contact_details}}
                </td>
                <td class="px-6 py-4">
                    {{$d->current_health}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>




@endsection