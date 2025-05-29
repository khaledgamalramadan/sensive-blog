@extends('theme.master')
@section('title', 'My Blogs')

@section('content')
    @include('theme.layout.hero', ['title' => 'My Blogs'])

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            @if (session('BlogDeletestatus'))
                <div class="alert alert-success">
                    {{ session('BlogDeletestatus') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col" width ="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <a href="{{ route('blogs.show', ['blog' => $blog]) }}" target="_blank">
                                                {{ $blog->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('blogs.edit', ['blog' => $blog]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('blogs.destroy', ['blog' => $blog]) }}" method="POST"
                                                style="display:inline;">


                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </button>
                                </form>
                                </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if (count($blogs) > 0)
                        {{ $blogs->render('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
