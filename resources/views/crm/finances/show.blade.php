@extends('layouts.base')

@section('caption', 'Information about employee: ' . $finance->full_name)

@section('title', 'Information about employee: ' . $finance->full_name)

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-6">
            @if(session()->has('message_success'))
                <div class="alert alert-success">
                    <strong>Well done!</strong> {{ session()->get('message_success') }}
                </div>
            @elseif(session()->has('message_danger'))
                <div class="alert alert-danger">
                    <strong>Danger!</strong> {{ session()->get('message_danger') }}
                </div>
            @endif
            <br/>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Basic information</a>
                        </li>
                        <div class="text-right">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                Delete this finance <li class="fa fa-trash-o"></li>
                            </button>
                        </div>

                    </ul>
                    <div class="tab-pane fade active in" id="home">
                        <h4></h4>

                        <table class="table table-striped table-bordered">
                            <tbody class="text-right">
                            <tr>
                                <th>Full name</th>
                                <td>{{ $finance->name }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $finance->description }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $finance->category }}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{ $finance->type }}</td>
                            </tr>
                            <tr>
                                <th>Gross</th>
                                <td>{{ Cknow\Money\Money::{App\Models\SettingsModel::getSettingValue('currency')}($finance->gross) }}</td>
                            </tr>
                            <tr>
                                <th>Net</th>
                                <td>{{ Cknow\Money\Money::{App\Models\SettingsModel::getSettingValue('currency')}($finance->net) }}</td>
                            </tr>
                            <tr>
                                <th>Vat</th>
                                <td>{{ Cknow\Money\Money::{App\Models\SettingsModel::getSettingValue('currency')}($finance->vat) }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ $finance->date }}</td>
                            </tr>
                            <tr>
                                <th>Assigned companies</th>
                                <td>
                                    <a href="{{ URL::to('companies/view/' . $finance->companies->id) }}">{{ $finance->companies->name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $finance->is_active ? 'Active' : 'Deactive' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">You want delete this finance?</h4>
                </div>
                <div class="modal-body">
                    Ation will delete permanently this finance.
                </div>
                <div class="modal-footer">
                    {{ Form::open(['url' => 'finances/delete/' . $finance->id,'class' => 'pull-right']) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this finance', ['class' => 'btn btn-small btn-danger']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection