@extends('layouts.app')

@section('content')
asdfsadf
    <a href="{{ url('demo') }}">返回</a>
    <form action="{{ url('demo/'.$demo->id ) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="{{ $demo->id }}">
    <table>
        <tr>
            <td>名称</td>
            <td>
                <input type="text" name="name" value="{{ $demo->name }}" />
            </td>
        </tr>
        <tr>
            <td>名称</td>
            <td>
                <input type="submit" name="sbu" value="提交" />
            </td>
        </tr>
    </table>
    </form>
@endsection