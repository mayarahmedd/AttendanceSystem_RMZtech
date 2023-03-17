@extends('Manage.layouts.app')
@section('content')
    <!-- Main content -->
    <div class="main-content" id="panel">
    @include('Manage.includes.header')
    <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0"> <a href="{{ route('dashboard') }}">Attendance</a></h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark radius">
                                    <li class="breadcrumb-item"><i class="fas fa-book-open"></i></li>
                                    <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Courses</a></li>
                                    <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center bg-white-100 radius shadow-2xl">
                            <h2 class="mt-4">{{ $course->name }}</h2>
                            <p class="mb-0">{{ $course->description }}</p>
                            <p class="text-bold"> {{ $course->students->count() }} <i class="fas fa-users-class text-blue"></i> </p>
                            <hr>
                            <div class="text-left">
                                <h2>List of Students</h2>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush datatable-basic">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">Name</th>
                                            <th scope="col" class="sort" data-sort="email">Email</th>
                                            <th scope="col" class="sort" data-sort="phone">Phone</th>
                                            <th scope="col" class="sort" data-sort="action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        @foreach ($course->students as $student)
                                            <tr>
                                                <td class="text-capitalize">
                                                    {{ $student->name }}
                                                </td>
                                                <td class="text-capitalize">
                                                    {{ $student->email }}
                                                </td>
                                                <td class="text-capitalize">
                                                    {{ $student->phone }}
                                                </td>
                                                <td class="text-capitalize">
                                                    <form action="{{ route('course.remove.student',[$course, $student]) }}" class="d-inline" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-sm bg-red-500 text-white radius" title="Remove student">
                                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
