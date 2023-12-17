@extends('layouts.app')

{{-- @section('title', $pageConfigs['title']) --}}

@section('page-style')
    {{-- page style css files --}}
@endsection

@section('content')
    <div class="grey-bg container-fluid">
        <section id="minimal-statistics">
            <div class="row">
                <div class="col-12 mt-3 mb-1">
                    <h4 class="text-uppercase">Dashboard</h4>
                    <p>Statistics</p>
                </div>
            </div>
            <div class="row">
                @foreach ($dashboardCards['dashboard_statistics'] as $dashboardCard)
                    <div class="col-xl-4 col-sm-12 col-12 mb-4">
                        <a href="{{ $dashboardCard['card_route'] }}">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <i class="icon-pencil primary font-large-2 float-left"></i>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h3>{{ $dashboardCard['card_value'] }}</h3>
                                                    <span>{{ $dashboardCard['card_title'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="row">
              <div class="col-12 mt-3 mb-1">
                  <p>Assigned Tasks Statistics</p>
              </div>
          </div>
          <div class="row">
              @foreach ($dashboardCards['assigned_tasks_statistics'] as $dashboardCard)
              <div class="col-xl-4 col-sm-12 col-12 mb-4">
                      <a href="{{ $dashboardCard['card_route'] }}">
                      <div class="card">
                          <div class="card-content">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="media d-flex">
                                              <div class="align-self-center">
                                                  <i class="icon-pencil primary font-large-2 float-left"></i>
                                              </div>
                                              <div class="media-body text-right">
                                                  <h3>{{ $dashboardCard['card_value'] }}</h3>
                                                  <span>{{ $dashboardCard['card_title'] }}</span>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </a>
                </div>
              @endforeach
          </div>

        </section>

    </div>
@endsection

@section('page-script')
    {{-- Page js files --}}
@endsection
