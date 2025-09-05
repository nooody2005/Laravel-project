@extends ('admin.layouts.app')

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />


@section('card')

<h1 class="text-center">welcome page </h1>
@if (!auth()->check())
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endif
<!-- 
@if($student)
    <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-primary">
        Your Information
    </a>
@else
    <p>You don't have a student profile yet.</p>
@endif -->




<p>User is @auth logged in @else not logged in @endauth</p>

    <!-- صورة تمتد على كامل العرض -->
    <div style="width: 100%; overflow: hidden; position: relative; max-height: 450px;">
        <img 
            src="{{ asset('storage/images/1.jpg') }}" 
            alt="Course Banner" 
            style="width: 100%; height: 450px; object-fit: cover; display: block;"
        >
    </div>

    <!-- ديسكريبشن تحت الصورة -->
    <div style="max-width: 900px; margin: 20px auto 60px; text-align: center; font-family: Arial, sans-serif; font-size: 1.3rem; color: #222; line-height: 1.5;">
        <p>
            Join our exclusive courses today and unlock your potential! Experience top-quality instruction from expert trainers, comprehensive content, and a supportive learning community designed to help you succeed and excel in your career.
        </p>
    </div>

    <!-- بقية الكورسات -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">All Departments</h5>
            
            
            <style>
                .departments-wrapper {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 30px;
                    justify-content: center;
                    padding: 10px;
                }
                .department-card {
                    border: 1.5px solid #aaa;
                    border-radius: 12px;
                    width: 350px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    text-align: center;
                    padding: 20px;
                    transition: transform 0.3s ease;
                }
                .department-card:hover {
                    transform: scale(1.05);
                    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
                }
                .department-card img {
                    width: 100%;
                    height: 220px;
                    object-fit: cover;
                    border-radius: 10px;
                    margin-bottom: 15px;
                }
                .department-card h3 {
                    font-size: 1.8rem;
                    margin-bottom: 8px;
                }
                .department-card p {
                     font-size: 1.1rem;
                     color: #555;
                     margin: 0;
                     
                     max-height: 90px;          /* ارتفاع ثابت للنص */
                     overflow: hidden;          /* اخفاء النص الزائد */
                     position: relative;
                     }

            </style>

            @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
        @if(session('department_id'))
       
    
 

            <form action="{{ route('departments.change', session('department_id')) }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">change</button>
            </form>
            <form action="{{ route('departments.cancelChange') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm">cancel</button>
            </form>

            
        @endif
    </div>
@endif


 <!-- @if(session('warning'))
  <div class="alert alert-warning">
    {{ session('warning') }}

    @if(session('department_id'))
      <form action="{{ route('departments.change', session('department_id')) }}" method="POST" style="display:inline-block;">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">تأكيد التغيير</button>
      </form>
    @endif

  </div>
@endif -->



              @if(session('msg'))
              <div class="alert alert-success">{{ session('msg') }}</div>
              @endif

            <div class="departments-wrapper">
                @foreach($departments as $department)
                    <div class="department-card">
                        <img src="{{ asset('storage/' . $department->photo) }}" alt="{{ $department->name }}">
                        <h3>{{ $department->name }}</h3>
                        <p class="description-text">{{ $department->description }}</p>
                     <a href="javascript:void(0)" class="read-more">Read more</a>

                      <!-- <form action="{{ route('departments.subscribe', $department->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">Subscribe</button>
                            </form> -->
                            <!-- <form action="{{ route('departments.subscribe', $department->id) }}" method="POST" onsubmit="return confirmSubscription(this, {{ $department->id }})"> -->
                                     @auth
            <form action="{{ route('departments.subscribe', $department->id) }}" method="POST" onsubmit="return confirmSubscription(this, {{ $department->id }})">
                @csrf
                <button type="submit" class="btn btn-primary mt-3">Subscribe</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-warning mt-3">Please login to subscribe</a>
        @endauth
    <!-- @csrf
    <button type="submit" class="btn btn-primary mt-3">Subscribe</button> -->
</form>

<!-- <script>
    function confirmSubscription(form, departmentId) {
        // تحقق من وجود رسالة تحذير مع department_id في الجلسة (هتحتاج تمريرها من السيرفر)
        // لكن للأسف الجلسة مش متاحة هنا، لذلك نستخدم طريقة أخرى:
        // بدلاً من الرسالة من السيرفر، نعتمد على حدث subscribe في السيرفر

        // استدعاء confirm بآلية بسيطة:
        return confirm('Are you sure to change department');
        // لو ضغط نعم ترجع true وتبعت الفورم
        // لو ضغط لا ترجع false وتمنع الإرسال
    }
</script> -->


                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection


<script>
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.go(1);
        };
    }
</script>


@yield('scripts')


