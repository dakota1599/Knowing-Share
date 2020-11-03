@extends('layout')

@section('title')
Logs
@endsection

@section('css')
<link rel="stylesheet" href="/css/logs.css">
@endsection


@section('content')

<div id="mainBody" class="container">

    <table class="table">
        <thead>
            <h2 class="tableHead">Logs</h2>
        </thead>
        <tfoot>
            {{$logs->links()}}
        </tfoot>
        <tbody>
            <tr>
                <th>
                    Email
                </th>
                <th>
                    Status
                </th>
                <th>
                    Time Stamp
                </th>
            </tr>

            @foreach($logs as $log)
                <tr class="@if($log->successful == 0) danger @else success @endif">
                    <td>
                        {{$log->email}}
                    </td>
                    <td>
                        @if($log->successful == 0)
                            Failed
                        @else
                            Success
                        @endif
                    </td>
                    <td>
                        {{$log->created_at}}
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>


</div>


@endsection