@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報作成</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily_report.store', $user_id], 'method' => 'POST']) !!}
      {!! Form::input('hidden', 'user_id', $user_id) !!}
      <div class="form-group form-size-small">
        {!! Form::input('hidden', 'reporting_time', date('Y-m-d H:i:d',time())) !!}
        <div class="form-control">{{ date('Y/m/d', time()) }}</div>
        <span class="help-block"></span>
      </div>
      <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
        {!! Form::input('text', 'title', '', ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('contents')? 'has-error' : '' }}">
        {!! Form::textarea('contents', '', ['class' => 'form-control', 'placeholder' => 'Content']) !!}
        <span class="help-block">{{ $errors->first('contents') }}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Add</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

