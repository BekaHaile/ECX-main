@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2 mb-3">
            @if($user->userType == 'Manager')
                @include('inc.managerSidenav')
            @endif
        </div>
        <div class="col-md-10 mb-3">
            <div class="jumbotron text-center bg-light">
                <div class="py-5 text-center">
                    <h2>Price Report of ECX</h2>
                </div>
                <div class="container" style="height: 50px;">
                    <form class="needs-validation" method="POST" action="/searchPriceReport">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <h4><label for="region">Region :</label></h4>
                                </div>
                                <div class="col-md-3 mb-3" style="margin-left: -30px;">
                                    <select class="form-control" id="region" name="region" >
                                        @foreach($region as $region1)
                                            <option @if($count == 1 && $region1->region == $regionSelect) selected @endif>{{$region1->region}}</option>
                                        @endforeach
                                        <option>All</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <h4><label for="grade">Grade :</label></h4>
                                </div>
                                <div class="col-md-3 mb-3" style="margin-left: -30px;">
                                    <select class="form-control" id="grade" name="grade">
                                        @foreach($grade as $grade1)
                                            <option @if($count == 1 && $grade1->washedGrade == $gradeSelect) selected @endif>{{$grade1->washedGrade}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3" style="margin-left: -60px;">
                                    <button class="btn btn-primary btn-md " type="submit" style="margin-bottom: 10px;">
                                        <span class="glyphicon glyphicon-search">search</span> </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @if($count == 0)
                    @if(count($coffees) > 0)
                        <div class="row">
                            <div class="col-md-8 mb-3" style="margin-left: 10px;">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar" style="margin-top: 20px;">
                                    <table class="table table-hover table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">Region</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($coffees as $coffee)
                                            <tr>
                                                <td>
                                                    {{ $coffee -> region }}
                                                </td>
                                                <td>
                                                    {{ $coffee -> washedGrade }}
                                                </td>
                                                <td>
                                                    {{ $coffee -> Price }}  birr
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3" style="margin-left: 10px;">
                                <canvas id="myChart" style="max-width: 500px;"></canvas>
                            </div>
                        </div>
                        {{ $coffees->links()}}
                    @endif
                @elseif($count == 1)
                    @if(count($coffees2) > 0)
                        <div class="row">
                            <div class="col-md-8 mb-3" style="margin-left: 160px;">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar" style="margin-top: 20px;">
                                    <table class="table table-hover table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">Region</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($coffees2 as $coffee)
                                            <tr>
                                                <td>
                                                    {{ $coffee -> region }}
                                                </td>
                                                <td>
                                                    {{ $coffee -> washedGrade }}
                                                </td>
                                                <td>
                                                    {{ $coffee -> Price }} birr
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3" style="margin-left: 10px;">
                                <canvas id="barChart"></canvas>
                                {{--{{$from}} - {{$to}}--}}
                            </div>
                        </div>
                        {{--{{ $coffees2->links()}}--}}
                    @endif
                @else
                    <p style="margin-top: 30px;"> <h4> No coffee to view.</h4></p>
                @endif
            </div>
        </div>
    </div>
    <script>
        var ctxB = document.getElementById("barChart").getContext('2d');
        var regions = [];
        var weight = [];
        @foreach ($region as $region1)
            regions.push('{{ $region1->region }}');
        @endforeach
        @if($count == 1)
        @foreach ($coffees2 as $coffee)
            weight.push('{{ $coffee->Weight }}');
        @endforeach
        @else
        @foreach ($coffees as $coffee)
            weight.push('{{ $coffee->Weight }}');
        @endforeach
        @endif
        var myBarChart = new Chart(ctxB, {
                type: 'bar',
                data: {
                    labels: regions,
                    datasets: [{
                        label: 'Weight of Coffee',
                        data: weight,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
    </script>
@endsection