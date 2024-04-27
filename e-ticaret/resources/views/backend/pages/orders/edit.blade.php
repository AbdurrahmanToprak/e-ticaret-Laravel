@extends('backend.layout.app')
@section('customcss')
    <style>
        body {
            background: #ccc;
            padding: 30px;
        }

        .container {
            width: 21cm;
            min-height: 29.7cm;
        }

        .invoice {
            background: #fff;
            width: 100%;
            padding: 50px;
        }

        .logo {
            width: 5cm;
        }

        .document-type {
            text-align: right;
            color: #444;
        }

        .conditions {
            font-size: 0.7em;
            color: #666;
        }

        .bottom-page {
            font-size: 0.7em;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sipariş Detayı</h4>
                    <div class="col-lg-12">
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @endif
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{session()->get('success')}}
                            </div>
                        @endif
                    </div>




                </div>

                <div class="container">
                    <div class="invoice">
                        <div class="row">
                            <div class="col-7">
                                <img src="{{asset('backend')}}/images/logo.jpg" class="logo">
                            </div>
                            <div class="col-5">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7 mt-2">
                                <p>
                                    <strong>ToprakShop</strong><br>
                                    Kalitenin Adresi...<br>
                                </p>
                            </div>
                            <div class="col-5">
                                <br><br><br>
                                <p>
                                    <strong>{{$invoice->name ?? ''}}</strong><br>
                                    <strong>Sipariş NO:</strong> <em>{{$invoice->order_no ?? ''}}</em><br>
                                    <strong>E-posta: </strong>{{$invoice->email ?? ''}}<br>
                                    <strong>Adres: </strong>{{$invoice->address ?? ''}}<br>
                                    <strong>Ülke: </strong>{{$invoice->country ?? ''}}<br>
                                    <strong>Şehir / İlçe: </strong>{{$invoice->city ?? ''}} / {{$invoice->district ?? ''}}<br>
                                    <strong>Sipariş Notu: </strong>{{$invoice->note ?? ''}}<br>
                                    <strong>Sipariş Tarihi: </strong>{{$invoice->created_at ?? ''}}
                                    <strong>Güncelleme Tarihi: </strong>{{$invoice->updated_at ?? ''}}
                                </p>
                            </div>
                        </div>
                        <br>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Ürün Adı</th>
                                <th>Adet</th>
                                <th>Fiyat</th>
                                <th>Kdv Oranı</th>
                                <th>Tutar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $alltotal = 0;
                            @endphp
                            @if(!empty($invoice->orders))
                                @foreach($invoice->orders as $item)
                                    @php
                                        $kdvOrani = $item['kdv'] ?? 0 ;
                                        $fiyat = $item['price'];
                                        $adet = $item['piece'];

                                        $kdvTutar = ($fiyat * $adet) * ($kdvOrani /100);
                                        $toplamTutar = $fiyat * $adet + $kdvTutar;
                                    @endphp
                                    <tr>
                                        <td>{{$item['name']}}</td>
                                        <td>{{$item['piece']}}</td>
                                        <td>{{$item['price']}}</td>
                                        <td>{{$item['kdv']}}</td>
                                        <td>{{$toplamTutar}} TL</td>
                                        @php
                                            $alltotal += $toplamTutar;
                                        @endphp
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-4">
                                <table class="table table-sm text-right">
                                    <tr>
                                        <td><strong>Toplam Tutar</strong></td>
                                        <td class="text-right">{{$alltotal}} TL</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <p class="conditions">
                            En votre aimable règlement
                            <br>
                            Et avec nos remerciements.
                            <br><br>
                            Conditions de paiement : paiement à réception de facture, à 15 jours.
                            <br>
                            Aucun escompte consenti pour règlement anticipé.
                            <br>
                            Règlement par virement bancaire.
                            <br><br>
                            En cas de retard de paiement, indemnité forfaitaire pour frais de recouvrement : 40 euros (art. L.4413 et L.4416 code du commerce).
                        </p>

                        <br>
                        <br>
                        <br>
                        <br>

                        <p class="bottom-page text-right">
                            90TECH SAS - N° SIRET 80897753200015 RCS METZ<br>
                            6B, Rue aux Saussaies des Dames - 57950 MONTIGNY-LES-METZ 03 55 80 42 62 - www.90tech.fr<br>
                            Code APE 6201Z - N° TVA Intracom. FR 77 808977532<br>
                            IBAN FR76 1470 7034 0031 4211 7882 825 - SWIFT CCBPFRPPMTZ
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{route('panel.order')}}" class="btn btn-light">Geri Dön</a>
    </div>
@endsection
