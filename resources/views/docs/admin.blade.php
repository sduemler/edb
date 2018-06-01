@extends('layouts.app')
@section('title', 'Admin Document')
@section('css')
<style>
    .container a {
        color: #0275d8 !important;
    }
</style>
@endsection
@section('js')

@endsection
@section('content')

@include('wiki.admin')

<h2>Forgot Administrator Password</h2>
<p>Follow these steps to reset password:</p>
    <ol>
        <li>Login to server</li>
        <li>go to application folder
            <pre><code class="language-bash">cd {{base_path()}}</code></pre>
        </li>
        <li>
            reset password by type this command
            <pre><code class="language-bash">php artisan admin:reset &lt;your email&gt; &lt;new password&gt;</code></pre>
        </li>
    </ol>
@endsection
