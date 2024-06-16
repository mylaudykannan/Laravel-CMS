@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card customCard my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                  <h5 class="text-white text-capitalize pl-3 mb-0">{{$user['name']}} Roles</h5>
                  <a href="{{URL('admin/user')}}" class="btn btn-default mb-0 mr-3 btn-sm text-white">Back to Users</a>
                </div>
              </div>
              <div class="card-body pt-2">
                @foreach($user->getRoleNames() as $rk => $rv) 
                    <span class="">{{$rv}} 
                        <a href="{{URL('admin/user/assignrolerevoke/'.$user['id'].'/'.$rv)}}" class="btn btn-sm btn-warning ml-2">Revoke Role</a>
                    </span>
                @endforeach
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">#</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $k => $v)
                        <tr>
                            <td class="text-xs font-weight-bold px-3">{{ $roles->firstItem() + $k }}</td>
                            <td class="text-xs font-weight-bold">{{$v['name']}}</td>
                            <td class="text-xs font-weight-bold">
                                @if($user->hasRole($v['name']))
                                    <a href="{{URL('admin/user/assignrolerevoke/'.$user['id'].'/'.$v['name'])}}"
                                    class="btn btn-sm btn-warning mb-0 font-weight-light">Revoke Role</a>
                                @else
                                    <a href="{{URL('admin/user/assignroleadd/'.$user['id'].'/'.$v['name'])}}"
                                    class="btn btn-sm btn-success mb-0 font-weight-light">Assign Role</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Card footer -->
              <div class="card-footer py-4">
                <nav aria-label="...">
                    <div class="justify-content-center mb-0">
                        {{$roles->appends(request()->input())->links('pagination.admin')}}
                    </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
        @include('admin.inc.footer')
    </div>
@endsection