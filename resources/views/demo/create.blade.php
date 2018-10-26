@extends('layouts.app')

@section('content')

    <a href="{{ url('demo') }}">返回</a>
    <form action="{{ url('demo/') }}" method="post">
    <table>
        <tr>
            <td>名称</td>
            <td>
                <input type="text" name="name" value="" />
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