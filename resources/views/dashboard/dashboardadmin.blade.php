@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none" aria-label="Page header">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Dashboard</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" /><path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" /><path d="M12 11v2a14 14 0 0 0 2.5 8" /><path d="M8 15a18 18 0 0 0 1.8 6" /><path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" /></svg></span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $rekappresensi->jmlhadir }} </div>
                        <div class="text-secondary">Total Attendance</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-license"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" /><path d="M9 7l4 0" /><path d="M9 11l4 0" /></svg></span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $rekapizin->jmlizin !== null ? $rekapizin->jmlizin : 0 }}</div>
                        <div class="text-secondary">Leave</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mood-sick"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18" /><path d="M9 10h-.01" /><path d="M15 10h-.01" /><path d="M8 16l1 -1l1.5 1l1.5 -1l1.5 1l1.5 -1l1 1" /></svg></span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $rekapizin->jmlsakit !== null ? $rekapizin->jmlsakit : 0 }}</div>
                        <div class="text-secondary">Sick Leave</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-9"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12h-3.5" /><path d="M12 7v5" /></svg></span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">{{ $rekappresensi->jmlterlambat !== null ? $rekappresensi->jmlterlambat : 0}}  </div>
                        <div class="text-secondary">Late</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
                </div>
            </div>
       
@endsection