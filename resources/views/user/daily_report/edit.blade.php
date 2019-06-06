@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily_report.update', $daily_report->id], 'method' => 'PUT']) !!}
      {!! Form::input('hidden', 'user_id', $daily_report->user_id, ['class' => 'form-control']) !!}
      <div class="form-group form-size-small ">
        {!! Form::input('date', 'reporting_time', date('Y-m-d', strtotime($daily_report->reporting_time)), ['class' => 'form-control']) !!}
      <span class="help-block"></span>
      </div>
      <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
        {!! Form::input('text', 'title', $daily_report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('contents')? 'has-error' : '' }}">
        {!! Form::textarea('contents', $daily_report->contents, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
        <span class="help-block">{{ $errors->first('contents') }}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">UPDATE</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

