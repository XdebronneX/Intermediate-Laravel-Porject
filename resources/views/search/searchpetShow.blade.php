@extends('layouts.main')
@section('body')
    <table class="container">
        <thead>
            <tr>
                <th>
                    <h1>Pet Name</h1>
                </th>
                <th>
                    <h1>Disease</h1>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petshoww as $show)
                <tr>
                    <td>{{ $show->pname }}</td>
                    <td>{{ $show->disease_name }}</td>
                </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
@endsection
