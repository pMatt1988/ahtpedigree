@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class='card-header'>Add an entry!</div>
                    <form class="card-body" action="/store" method="post">
                        <div class="row form-group">
                            <label for="registered_name" class="col-md-4 col-form-label text-md-right">Registered
                                Name</label>
                            <input type="text" id="registered_name" name="registered_name" class="form-control col-md-6"
                                   placeholder="Registered Name">
                        </div>
                        <div class="row form-group">
                            <label for="registered_name" class="col-md-4 col-form-label text-md-right">Registration
                                Number</label>
                            <input type="text" id="registration_number" name="registered_name" class="form-control col-md-6"
                                   placeholder="Registration Number">
                        </div>
                        <div class="row form-group">
                            <div class="offset-md-4 col-md-6 p-0">
                                <button type="submit" class="ml-0 btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection