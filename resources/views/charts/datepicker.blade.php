@extends('layouts.main')
@section('body')
    <form method="get" enctype="multipart/form-data" action="{{ route('chart.date') }}">

        <div class="modal-body mx-3" id="inputCustomerModal">
            <div class="md-form mb-5"> </div>
            <i class="fa-solid fa-compact-disc prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name"
                style="display: inline-block;
            width: 150px; ">Start</label>
            <input type="date" id="title" class="form-control validate" name="start">

            <div class="modal-body mx-3" id="inputCustomerModal">
                <div class="md-form mb-5"> </div>
                <i class="fa-solid fa-compact-disc prefix grey-text"></i>
                <label data-error="wrong" data-success="right" for="name"
                    style="display: inline-block;
            width: 150px; ">End</label>
                <input type="date" id="title" class="form-control validate" name="end">
                <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
