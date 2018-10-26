@extends('layouts.app')

@section('content')

    <a href="{{ url('demo/create') }}">创建1</a>
    <table>
    @foreach($demos as $demo)
        <tr>
            <td>{{ $demo->name }}</td>
            <td>
                <a href="{{ url('demo/'.$demo->id) }}">查看</a>
                <a href="{{ url('demo/'.$demo->id.'/edit') }}">编辑</a>
            </td>
        </tr>
    @endforeach
    </table>
@endsection