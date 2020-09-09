@extends('layouts.main')

@section('title')
    Home -
@endsection

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class=" container ">
                <div class="row">
                    <div class="col-md-5">
                        <div id="chartProgresJalur" style="width: 100%; height: 200px; background-color: #FFFFFF;" ></div>
                        <br><br>
                        <div id="chartPersentase" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body p-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        @foreach($jalur as $key => $value)
                                            <tr>
                                                <td class="p-2">{{ $value->nama }}</td>
                                                <td width="50%" class="px-2" style="vertical-align: middle;">
                                                    <div class="progress">
                                                        @php($progres = round($value->progres, 2))
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $progres }}%;" aria-valuenow="{{ $progres }}" aria-valuemin="0" aria-valuemax="100">{{ $progres }}%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/serial.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pie.js') }}"></script>
    <script>
        AmCharts.makeChart("chartProgresJalur",
            {
                "type": "serial",
                "categoryField": "nama",
                "rotate": true,
                "startDuration": 1,
                "categoryAxis": {
                    "gridPosition": "start",
                    "labelsEnabled": false
                },
                "trendLines": [],
                "graphs": [
                    {
                        "balloonText": "[[title]] :[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-1",
                        "title": "Pencapaian",
                        "type": "column",
                        "valueField": "pencapaian"
                    },
                    {
                        "balloonText": "[[title]] :[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-2",
                        "title": "Sisa",
                        "type": "column",
                        "valueField": "sisa"
                    }
                ],
                "guides": [],
                "valueAxes": [
                    {
                        "id": "ValueAxis-1",
                        "stackType": "100%",
                        "title": ""
                    }
                ],
                "allLabels": [],
                "balloon": {},
                "legend": {
                    "enabled": true,
                    "useGraphSettings": true
                },
                "dataProvider": JSON.parse(`{!! json_encode($dataProgresJalur) !!}`)
            }
        );

        AmCharts.makeChart("chartPersentase",
            {
                "type": "pie",
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                "titleField": "nama",
                "valueField": "nilai",
                "allLabels": [],
                "balloon": {},
                "labelsEnabled": false,
                "legend": {
                    "enabled": true,
                    "align": "center",
                    "markerType": "circle"
                },
                "titles": [],
                "dataProvider": JSON.parse(`{!! json_encode($dataPersentase) !!}`)
            }
        );
    </script>
@endpush
