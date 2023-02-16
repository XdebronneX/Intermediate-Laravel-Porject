@extends('layouts.main')
@section('body')
    <table class="container">
        <thead>
            <tr>
                <th>
                    <h1>Customer Name</h1>
                </th>
                <th>
                    <h1>Pet Name</h1>
                </th>
                <th>
                    <h1>Service Name</h1>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customershoww as $show)
                <tr>
                    <td>{{ $show->fname . ' ' . $show->lname }}</td>
                    <td>{{ $show->pname }}</td>
                    <td>{{ $show->service_name }}</td>
                </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
@endsection
