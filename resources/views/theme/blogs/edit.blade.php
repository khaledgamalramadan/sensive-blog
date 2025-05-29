@extends('theme.master')
@section('title', 'Edit Blog')

@section('content')
    @include('theme.layout.hero', ['title' =>$blog->name, 'subtitle' => 'Edit Blog'])

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form class="form-contact contact_form" action="{{ route('blogs.update',['blog' => $blog]) }}"
                        method="POST" id="contactForm"
                        novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if (session('BlogUpdatestatus'))
                                <div class="alert alert-success">
                                    {{ session('BlogUpdatestatus') }}
                                </div>
                            @endif

                        <div class="form-group">
                            <input class="form-control border" name="name" id="name" value="{{ $blog->name }}"
                                type="text" placeholder="Enter your name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <input class="form-control border" name="image" id="image" type="file">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <select class="form-control border" name="category_id" id="category_id">
                                <option value="">Select Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if($category->id == $blog->category_id)
                                                selected
                                            @endif> {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <textarea class="w-100 border" rows="5" name="description" id="description"
                                placeholder="Enter your blog description">{{ $blog->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
