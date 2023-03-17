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
                            <h6 class="h2 text-white d-inline-block mb-0">{{ $pageTitle }}</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark radius">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Students</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $student->name }}</li>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center bg-gray-100 radius shadow-2xl">

                            <h1 class="mt-4">{{ $student->name }}</h1>
                            <blockquote class="blockquote mb-0">
                                <p class="mb-0">{{ $student->email }}</p>
                                <p class="mb-0 text-bold"><a href="tel:{{ $student->phone }}">{{ $student->phone }}</a> </p>

                            </blockquote>
                        </div>
                    </div>
                </div>
                <!-- Stats -->
                <div class="col-md-6">
                    <div class="card bg-gradient-default radius shadow-2xl">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-white mb-0">Total Courses</h5>
                                    <span class="h2 font-weight-bold text-white mb-0">{{ $student->courses->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-gradient-default radius shadow-2xl">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-white mb-0">Total Attendance</h5>
                                            <span class="h2 font-weight-bold text-white mb-0">{{ $student->present_count() }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-gradient-default radius shadow-2xl">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-white mb-0">Total Absence</h5>
                                            <span class="h2 font-weight-bold text-white mb-0">{{ $student->absent_count() }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                                                <i class="fas fa-calendar-minus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COURSES -->
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <!-- Table -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Courses</h3>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush datatable-buttons">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="course">Course</th>
                                    <th scope="col" class="sort" data-sort="action">Action</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($student->courses as $course)
                                    <tr>
                                        <td class="text-capitalize">
                                            <span class="badge badge-primary text-lg rounded-circle">
                                                {{ $loop->iteration }}
                                            </span>
                                        </td>
                                        <td class="text-capitalize">
                                            {{ $course->name }}
                                        </td>
                                        <td>
                                            <button data-toggle="modal" data-target="#updateCourse-{{ $course->id }}" class="btn btn-sm bg-green-500 text-white m-0 radius" title="edit">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </button>
                                            <!-- Update Class Modal -->
                                        @include('Manage.pages.Course.modals.UpdateCourseModal', ['course' => $course])
                                        <!--/ Update Class Modal -->
                                            <a href="{{ route('course.show', $course) }}" class="btn btn-sm bg-blue-500 text-white m-0 radius" title="edit">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('course.assign-student', $course) }}" class="btn btn-sm bg-yellow-500 text-white m-0 radius" title="Assign Students">
                                                <i class="fas fa-users-class" aria-hidden="true"></i>
                                            </a>
                                            <form action="{{ route('course.destroy', $course) }}" class="d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure? this action will remove all assigned students too')" type="submit" class="btn btn-sm bg-red-500 text-white radius" title="delete">
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
                    <!--/ Table -->
                </div>
            </div>
        </div>
        <!--/ courses -->
    </div>
@endsection
