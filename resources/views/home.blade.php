@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mb-3">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          <div class="alert alert-info">Welcome, start managing your content here.</div>
          <div class="row">
            
            <div class="col-md-6">
              <div class="card mb-2">
                <div class="card-body">
                  <a class="d-flex align-items-center" href="/admin/surveys"><i class="material-icons">post_add</i>
                    <span>Manage surveys</span></a>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="card mb-2">
                <div class="card-body">
                  <a class="d-flex align-items-center" href="/admin/banners"><i class="material-icons">photo_filter</i>
                    <span>Manage banners</span></a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Update site logo</div>
            <div class="card-body">
              <update-logo :logo="'{{ asset('storage/brand-logo.png') }}'" />
            </div>
          </div>
        </div>
      </div>
      
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <i class="material-icons mr-3">lock</i>
              Account credentials
            </div>
            <div class="card-body">
              <update-credentials :email="'{{ Auth::user()->email }}'"/>
            </div>
          </div>
        </div>
      </div>
      
      <siteconfig :siteconfig="{{ json_encode($siteconfig) }}"/>
      
    </div>
  </div>
</div>
@endsection
