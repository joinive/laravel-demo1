@extends('layouts.app')

@section('content')

    <a href="{{ url('demo') }}">返回</a>
    <table>
        <tr>
            <td>名称</td>
            <td>
                {{ $demo->name }}
            </td>
        </tr>
    </table>
@endsection