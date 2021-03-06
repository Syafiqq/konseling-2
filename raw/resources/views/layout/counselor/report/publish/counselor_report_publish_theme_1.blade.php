@extends('layout.counselor.extension.adminlte-sidebar')
<?php
/** @var \App\Eloquent\User $student */
/** @var \App\Eloquent\UserStudents $studentProfile */
/** @var \App\Eloquent\Answer $studentAnswer */
$counselorProfile = $user->counselor()->first();
$studentProfile = $student->student()->first();
$studentAnswer = $student->getAttribute('answer')->first();
$accumulation = $studentAnswer->answer_result()->sum('result');
$analytics = $studentAnswer->getResultAnalytics($accumulation);
$now = \Carbon\Carbon::now();
?>
@section('head-title')
    <title>Cetak</title>
@endsection

@section('head-description')
    <meta name="description" content="Cetak">
@endsection

@section('body-content')
    @parent
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                &nbsp;
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    Report
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    Detail
                </li>
                <li class="active">
                    <i class="fa fa-print"></i>
                    Print
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <page class="page" size="A4" id="printable-area">
                <div class="container" id="print_container">
                    <div class="row vertical-align">
                        <div class="col-sm-3">
                            <img src="{{asset('/assets/img/avatar/logo/logo.png')}}" alt="UM" class="img-rounded img-responsive center-block" style="width: 3.5cm; height: 3.5cm">
                        </div>
                        <div class="col-sm-9">
                            <p class="margin-bottom-2" id="header_department">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</p>
                            <p class="margin-bottom-2" id="header_university">UNIVERSITAS NEGERI MALANG (UM)</p>
                            <p class="margin-bottom-2" id="header_faculty">FAKULTAS ILMU PENDIDIKAN</p>
                            <p class="margin-bottom-2" id="header_faculty">JURUSAN BIMBINGAN DAN KONSELING</p>
                            <p></p>
                            <p class="margin-bottom-2" id="header_u_address">Jalan Semarang 5 Malang 65145</p>
                            <p class="margin-bottom-2" id="header_u_desc">Telepon: 0341-566962, Laman: www.um.ac.id</p>
                        </div>
                    </div><!--/row-->
                    <div class="row vertical-align">
                        <div class="col-sm-12">
                            <hr class="bigHr">
                        </div>
                    </div>
                    <div class="row vertical-align">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3 text-center">
                            <div id="secret_container">
                                <p id="secret">RAHASIA</p>
                            </div>
                        </div>
                    </div>
                    <div class="row vertical-align">
                        <div class="col-sm-12 text-center">
                            <p id="content_welcome" class="margin-bottom-4" style="font-weight: bold; font-size: 20px">LAPORAN HASIL INVENTORI</p>
                            <p id="content_title" style="font-weight: bolder; font-size: 20px; margin: 4px">
                                <b>
                                    <i>SCHOOL ENGAGEMENT</i>
                                </b>
                                SISWA
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row vertical-align">
                        <div class="col-sm-1 ">
                        </div>
                        <div class="col-sm-2 text-left">
                            <p class="margin-left-1-cm">Nama</p>
                        </div>
                        <div class="col-sm-3 no-padding-side">
                            <p>: {{$student->getAttribute('name')}}</p>
                        </div>
                        <div class="col-sm-2 text-left">
                            <p>Sekolah</p>
                        </div>
                        <div class="col-sm-3 no-padding-side">
                            <p>: {{$studentProfile->getAttribute('school')}}</p>
                        </div>
                    </div>
                    <div class="row vertical-align">
                        <div class="col-sm-1 ">
                        </div>
                        <div class="col-sm-2 text-left">
                            <p class="margin-left-1-cm">NIS</p>
                        </div>
                        <div class="col-sm-3 no-padding-side">
                            <p>: {{$student->getAttribute('credential')}}</p>
                        </div>
                        <div class="col-sm-2 text-left">
                            <p>Jenis Kelamin</p>
                        </div>
                        <div class="col-sm-3 no-padding-side">
                            <p>: {{$student->getGenderTranslation()}}</p>
                        </div>
                    </div>
                    <div class="row vertical-align">
                        <div class="col-sm-1 ">
                        </div>
                        <div class="col-sm-2 text-left">
                            <p class="margin-left-1-cm">Kelas</p>
                        </div>
                        <div class="col-sm-3 no-padding-side">
                            <p>: {{$studentProfile->getAttribute('grade')}}</p>
                        </div>
                        <div class="col-sm-2 text-left">
                            <p>Tanggal Pengisian</p>
                        </div>
                        <div class="col-sm-3 no-padding-side">
                            <p>: {{$studentAnswer->getAttribute('finished_at')->formatLocalized('%d %B %Y')}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10 text-center">
                            <p id="content_welcome" style="font-weight: bold; font-size: 16px; margin: 4px">HASIL ANALISA</p>
                            <b><?php printf("%.4g%%", $accumulation) ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <table class="color-transparent custom-table">
                                <thead>
                                <tr>
                                    <th width="150" class="text-center font-size-14px">
                                        <b>Interval Persentase</b>
                                    </th>
                                    <th width="150" class="text-center font-size-14px">
                                        <b>Klasifikasi</b>
                                    </th>
                                    <th class="text-center font-size-14px">
                                        <b>Interpretasi</b>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="font-size-12px text-center">
                                        <strong>{{$analytics['interval']}}</strong>
                                    </td>
                                    <td class="font-size-12px text-center">
                                        <strong>{{$analytics['class']}}</strong>
                                    </td>
                                    <td class="font-size-12px text-center">
                                        <strong>{{$analytics['description']['key']}}</strong>
                                        <ol>
                                            @foreach($analytics['description']['value'] as $interpretation)
                                                <li class="text-left">
                                                    <strong>{{$interpretation}}</strong>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10 text-left">
                            <p style="margin: 4px; font-size: 16px;">
                            </p>
                        </div>
                    </div>
                    <div class="row" style="margin-top: .5cm">
                        <div class="col-sm-7 ">
                        </div>
                        <div class="col-sm-5 no-padding-side">
                            <p class="margin-bottom-2">Malang, {{$now->formatLocalized('%d %B %Y')}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1 ">
                        </div>
                        <div class="col-sm-4 no-padding-side">
                            <p class="margin-bottom-2">Kepala Sekolah {{$counselorProfile->getAttribute('school')}}</p>
                        </div>
                        <div class="col-sm-2 ">
                        </div>
                        <div class="col-sm-5 no-padding-side">
                            <p class="margin-bottom-2">Konselor</p>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 1.2cm">
                        <div class="col-sm-1 ">
                        </div>
                        <div class="col-sm-4 no-padding-side">
                            <p class="margin-bottom-2">{{$counselorProfile->getAttribute('school_head')}}</p>
                        </div>
                        <div class="col-sm-2 ">
                        </div>
                        <div class="col-sm-5 no-padding-side">
                            <p class="margin-bottom-2">{{$user->getAttribute('name')}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1 ">
                        </div>
                        <div class="col-sm-4 no-padding-side">
                            <p class="margin-bottom-2">{{$counselorProfile->getAttribute('school_head_credential')}}</p>
                        </div>
                        <div class="col-sm-2 ">
                        </div>
                        <div class="col-sm-5 no-padding-side">
                            <p class="margin-bottom-2">{{$user->getAttribute('credential')}}</p>
                        </div>
                    </div>
                </div>
            </page>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('head-css-post')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/css/layout/counselor/report/publish/counselor_report_publish_theme_1.min.css')}}">
@endsection

@section('body-js-lower-post')
    @parent
    <script type="text/javascript" src="{{asset('/assets/vendor/jQuery.print/jQuery.print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/js/layout/counselor/report/publish/counselor_report_publish_theme_1.min.js')}}"></script>
@endsection

@section('body-content-navbar')
    @include('layout.counselor.extension.navbar.theme_1_navbar', ['pre_right_menu' => "<li><a href=\"\" id=\"print\" ><i class=\"fa fa-print\"></i></a></li>"])
@endsection

