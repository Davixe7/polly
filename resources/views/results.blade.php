@extends('layouts.public')
@section('head')
<meta property="og:image" content="{{ url(str_replace('public', '/storage', $survey->choices->first()->image)) }}" />
<meta property="og:title" content="{{ $survey->name }}">
<meta property="og:description" content="Come take this survey now" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ $survey->name }}" />
<meta name="twitter:description" content="Come take this survey now" />
<meta name="twitter:image:src" content="{{ url(str_replace('public', '/storage', $survey->choices->first()->image)) }}" />
@endsection

@section('content')

@if( $admin_banner )
<div class="banner">
  <img src="{{ str_replace('public','/storage',$admin_banner->image) }}" alt="">
</div>
@endif

<h1 class="text-primary">Survey Results</h1>
<article>
  <div class="results-header">
    <h1>{{ $survey->name }}</h1>
    @if( isset($choice) )
    <div class="vote-confirmation">
      <div class="sup">Your vote was:</div>
      <div class="choice-name">{{ $choice->name }}</div>
    </div>
    @endif
  </div>
  <div class="survey-result-choices">
  @if( $choice )
    <div class="survey-results-choice selected">
      <div class="picture-wrap">
        <img src="{{ $choice->picture }}" alt="#">
      </div>
      <div class="details">
        <div class="name">{{ $choice->name }}</div>
        <div class="progress-bar">
          <div style="width:{{ $choice->votes_percent }}%" class="progress">{{ $choice->votes_percent }}%</div>
        </div>
        <div class="votes-count">
          {{ $choice->votes_count }}
        </div>
      </div>
    </div>
  @endif
  @foreach( $survey->choices as $c )
    <div class="survey-results-choice"
      class="@if($c->name == 'Cocacola') first @endif">
      <div class="picture-wrap">
        <img src="{{ $c->picture }}" alt="#">
      </div>
      <div class="details">
        <div class="name">{{ $c->name }}</div>
        <div class="progress-bar">
          <div style="width:{{ $c->votes_percent }}%" class="progress">{{ $c->votes_percent }}%</div>
        </div>
        <div class="votes-count">
          {{ $c->votes_count }}
        </div>
      </div>
    </div>
  @endforeach
  </div>

  <hr>

  <div class="results-total">
    <div class="legend">Total Votes:</div>
    <div style="width: 100%;">
      <div class="votes-count">
        {{ $survey->votes_count }}
      </div>
      <div class="dates">
        <div>{{ $survey->created_date }}</div>
        <div>{{ $survey->days_left }}</div>
      </div>
    </div>
  </div>

  @include('partials.sharer', ['survey'=>$survey,'mode'=>'results', 'horizontal'=>true])
</article>
@endsection