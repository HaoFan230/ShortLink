@extends('layout.app')

@section('content')
<form action="{{ route('checkemail.store') }}" method="POST">
    @csrf()
    <a class="btn bg-white text-primary mr-2" href="https://mail.qq.com" target="_blank">进入邮箱</a>
    <button class="btn btn-info {{ old('sendStatus') ? 'disabled' : '' }}">{{ old('sendStatus') ? '邮件已发送' : '重新发送认证邮件' }}</button>
</form>
@endsection