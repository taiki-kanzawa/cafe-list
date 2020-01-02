@extends('layouts.app')

@section('content')
    <!-- 検索フォーム -->
　　<form>
　　    <div class="offset-2 col-8">
            <div class="form-group input-group">
                <input type="text" class="form-control">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </div>
        </div>
    </form>
    
    <!-- 見出し -->
    <div class="text-center mt-5 mb-5">
        <h2>一覧</h2>
    </div>
@endsection