<x-layout.app title="Laporan Pembayaran" activeMenu="laporan-pembayaran">
    <div class="container my-5">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="order-last col-12 col-md-8 order-md-1">
                        <h3>{{ __('Laporan Pembayaran') }}</h3>
                        <p class="text-subtitle text-muted">
                            {{ __('Below is a list of all laporan pembayaran.') }}
                        </p>
                    </div>
                    <x-breadcrumb>
                        <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Laporan Pembayaran') }}</li>
                    </x-breadcrumb>
                </div>
            </div>

            <section class="section">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @grid([
                                        'dataProvider' => $dataProvider, // see info about DataProviders
                                        'rowsPerPage' => $perPage,
                                        'columnOptions' => [
                                            'class' => 'attribute',
                                            'formatters' => ['text', 'raw'],
                                        ],
                                        'columns' => [
                                            [
                                                'class' => 'raw',
                                                'title' => 'No',
                                                'value' => function () use (&$i) {
                                                    return ++$i . '.';
                                                },
                                            ],
                                            [
                                                'class' => 'raw',
                                                'attribute' => 'nama_bulan',
                                                'title' => 'Bulan',
                                                'formatters' => ['raw'],
                                                'value' => function ($row) {
                                                    return $row->nama_bulan;
                                                },
                                            ],
                                            [
                                                'class' => 'raw',
                                                'attribute' => 'pakai',
                                                'title' => 'Pemakaian/Bulan',
                                                'formatters' => ['raw'],
                                                'value' => function ($row) {
                                                    return $row->pakai;
                                                },
                                            ],
                                            [
                                                'class' => 'raw',
                                                'attribute' => 'nominal',
                                                'title' => 'Subtotal',
                                                'formatters' => ['raw'],
                                                'value' => function ($row) {
                                                    return $row->nominal;
                                                },
                                            ],
                                            [
                                                'class' => 'raw',
                                                'attribute' => 'updated_at',
                                                'title' => 'Updated At',
                                                'formatters' => ['raw'],
                                                'value' => function ($row) {
                                                    return $row->updated_at->format('d-m-Y H:i:s');
                                                },
                                            ],
                                            [
                                                'class' => 'raw', // class option allows to change column class
                                                'formatters' => ['raw'],
                                                'value' => function ($row) {
                                                    return view('roles.include.action', ['row' => $row])->render();
                                                },
                                            ],
                                        ],
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-layout.app>
