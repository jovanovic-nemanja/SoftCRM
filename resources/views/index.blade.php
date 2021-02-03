@extends('layouts.base')

@section('title', 'Welcome in SoftCRM')

@section('caption', 'Welcome in SoftCRM')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-green">
                <div class="panel-body boxes">
                    <i class="fa fa-female fa-3x"></i>
                    <h3 style="padding:8px;font-size:18px">Clients: {{ Cache::get('countClients') }}
                        ({{ Cache::get('deactivatedClients') }})
                    </h3>
                </div>
                <a href="{{ route('clients') }}" style="text-decoration: none">
                    <div class="panel-footer back-footer-green boxes-font">
                        {{ Cache::get('clientsInLatestMonth') }} Increase in 30 Days
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-blue">
                <div class="panel-body boxes">
                    <i class="fa fa-compass fa-3x"></i>
                    <h3 style="padding:8px;font-size:18px">Companies: {{ Cache::get('countCompanies') }}
                        ({{ Cache::get('deactivatedCompanies') }})
                    </h3>
                </div>
                <a href="{{ route('companies') }}" style="text-decoration: none">
                    <div class="panel-footer back-footer-blue boxes-font">
                        {{ Cache::get('companiesInLatestMonth') }} Increase in 30 Days
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-red">
                <div class="panel-body boxes">
                    <i class="fa fa fa-users fa-3x"></i>
                    <h3 style="padding:8px;font-size:18px">Employees: {{ Cache::get('countFinances') }}
                        ({{ Cache::get('deactivatedEmployees') }})
                    </h3>
                </div>
                <a href="{{ route('employees') }}" style="text-decoration: none">
                    <div class="panel-footer back-footer-red boxes-font">
                        {{ Cache::get('employeesInLatestMonth') }} Increase in 30 Days
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-brown">
                <div class="panel-body boxes">
                    <i class="fa fa-paperclip fa-3x"></i>
                    <h3 style="padding:8px;font-size:18px">Deals: {{ Cache::get('countDeals') }}
                        ({{ Cache::get('deactivatedDeals') }})
                    </h3>
                </div>
                <a href="{{ route('deals') }}" style="text-decoration: none">
                    <div class="panel-footer back-footer-brown boxes-font">
                        {{ Cache::get('dealsInLatestMonth') }} Increase in 30 Days
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $tasksGraphData->render() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $itemsCountGraphData->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Latest tasks <span class="badge"> {{ Cache::get('countTasks') }}</span></button>
                    <span style="float: right">Completed: {{ Cache::get('completedTasks') }}
                        | Uncompleted: {{ Cache::get('uncompletedTasks') }}</span>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @if(count($dataWithAllTasks) > 0)
                            @foreach ($dataWithAllTasks as $result)
                                <a href="{{ URL::to('tasks/view/' . $result['id']) }}" class="list-group-item">
                                    <span class="badge badge"
                                          style="background-color: #428bca !important;">{{ $result['created_at']->diffForHumans() }}</span>
                                    <span class="badge badge"
                                          style="background-color: #ca4e6e !important;">Duration: {{ $result['duration'] . ' days' }}</span>
                                    <i class="fa fa-fw fa-comment"></i> {{ $result['name'] }}
                                </a>
                            @endforeach
                        @else
                            There is no tasks.
                        @endif
                    </div>
                    <div class="text-right">
                        <a href="{{ URL::to('tasks') }}">More Tasks <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Latest add companies <span class="badge"> {{ Cache::get('countCompanies') }}</span>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @if(count($dataWithAllCompanies) > 0)
                            @foreach ($dataWithAllCompanies as $result)
                                <a href="{{ URL::to('companies/view/' . $result->id) }}" class="list-group-item">
                                    <i class="fa fa-compass"></i> {{ $result->name }}
                                    <span class="badge badge"
                                          style="background-color: #ff9800 !important;">Phone: {{ $result->phone }}</span>
                                </a>
                            @endforeach
                        @else
                            There is no companies.
                        @endif
                    </div>
                    <div class="text-right">
                        <a href="{{ URL::to('companies') }}">More companies <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Latest add products <span class="badge"> {{ Cache::get('countProducts') }}</span>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @if(count($dataWithAllProducts) > 0)
                            @foreach ($dataWithAllProducts as $result)
                                <a href="{{ URL::to('products/view/' . $result->id) }}" class="list-group-item">
                                    <span class="badge badge"
                                          style="background-color: #428bca !important;">{{ $result->created_at->diffForHumans() }}</span>
                                    <span class="badge badge" style="background-color: #8a3a44 !important;">
                                         {{ $result->count }} qty</span>
                                    <span class="badge badge" style="background-color: #298a15 !important;">
                                        {{ Cknow\Money\Money::{$currency}($result->price) }}</span>
                                    <i class="fa fa-fw fa-product-hunt"></i> {{ $result->name }}
                                </a>
                            @endforeach
                        @else
                            There is no products.
                        @endif
                    </div>
                    <div class="text-right">
                        <a href="{{ URL::to('products') }}">More products <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection