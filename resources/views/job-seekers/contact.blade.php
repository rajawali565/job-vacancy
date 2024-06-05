@extends ('landing-page.layouts.main')
@section('content')
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center"
                data-background="/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Contact us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Testimoni Anda</h2>
                    </div>
                    <div class="col-lg-8">
                        <form class="form-contact contact_form" action="{{ URL::to('job-seekers/contact') }}" method="post" enctype="multipart/form-data" id="contactForm" novalidate="novalidate">
                            @csrf
{{-- 
                        @if (isset($testimoni))
                            <form method="POST" action="{{ URL::to('job-seekers/contact/' . $testimoni->id) }}"
                                autocomplete="off">
                                @method('put')
                            @else
                                <form method="POST" action="{{ URL::to('job-seekers/contact') }}" autocomplete="off"
                                    enctype="multipart/form-data">
                        @endif

                        @csrf --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" cols="30"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter name'"
                                        placeholder="Enter name"></input>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="quote" id="quote" cols="30" rows="9"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Quote'" placeholder="Enter Quote"></textarea>
                                    @error('quote')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="job" class="form-control w-100 @error('job') is-invalid @enderror"
                                        name="category_id">
                                        <option value="" disabled>-- Silahkan Pilih Kategori --</option>
                                        @foreach ($jobcategories as $jobcategory)
                                            <option class="form-control" value="{{ $jobcategory->id }}"
                                                {{ isset($company) ? ($company->job === $jobcategory->id ? 'selected' : '') : '' }}>
                                                {{ $jobcategory->category }}</option>
                                        @endforeach
                                    </select>
                                    @error('job')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Buttonwood, California.</h3>
                                <p>Rosemead, CA 91770</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+1 253 565 2365</h3>
                                <p>Mon to Fri 9am to 6pm</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>support@colorlib.com</h3>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ contact section end ================= -->
    </main>
@endsection
