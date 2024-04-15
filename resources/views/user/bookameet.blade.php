@extends('user.layout.main')
@section('content')

<?php

use App\Models\Meet;

$meets = Meet::where('user_id', auth()->user()->id)->get();
?>
<div class="flex items-center justify-between">
    <h1 class="p-5" style="font-size: 20px; font-weight:bold">Book A Meet</h1>
    <a href="/add-book-a-meet" class=" mr-5"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button></a>
</div>


<div class="relative overflow-x-auto p-5">
    <h2 class="font-bold my-3">Scheduled Meetings</h2>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Booking Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Meet Link
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($meets as $meet)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$meet->email}}
                </th>
                <td class="px-6 py-4">
                    @if($meet->date_and_time)
                    {{$meet->date_and_time}}
                    @else
                    ---
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($meet->status == '1')
                    Pending
                    @elseif($meet->status == '2')
                    Approved
                    @else
                    Cancelled
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($meet->link)
                    {{$meet->link}}
                    @else
                    ---
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        console.log('hello')
        var res = await fetch('https://auth.calendly.com/oauth/token').then(res => res.json()).then((data) => data)
        console.log(res)

    })
</script>
@endsection