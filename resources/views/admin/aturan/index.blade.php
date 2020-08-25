@extends('admin.default')

@section('page-header')
    Aturan <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.aturan.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Gejala</th>
                    <th>Penyakit</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items  as $item)
                    <tr>
                        <td>{{ !empty($item) ? $item->kode : '-' }}</td>
                        <td>
                        @php $i=1; @endphp
                        @foreach(json_decode($item->gejala, true) as $gt)
                            @foreach($gejala as $g)
                                @if($gt == $g->id) 
                                    @if($i==1)
                                        {{$g->name}}
                                    @else
                                        <b> AND </b>{{$g->name}}
                                    @endif
                                    @php $i++; @endphp
                                @endif
                            @endforeach
                        @endforeach
                        </td>
                        <td>{{ !empty($item->id_penyakit) ? $item->penyakit->name : '-' }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.aturan.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.aturan.destroy', $item->id),
                                        'method' => 'DELETE',
                                        ])
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection
