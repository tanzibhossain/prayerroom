<script src="{{ asset('frontend/js/custom.js') }}"></script>
@php
    $g_settings = \App\Models\GeneralSetting::where('id',1)->first();
@endphp
@if($g_settings->layout_direction == 'ltr')
    <script src="{{ asset('frontend/js/ltr.js') }}"></script>
@endif
@if($g_settings->layout_direction == 'rtl')
    <script src="{{ asset('frontend/js/rtl.js') }}"></script>
@endif

@if ($errors->any())
    @foreach($errors->all() as $error)
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1800,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: 'error',
            title: '{{ $error }}'
        });
    </script>
    @endforeach
@endif

@if(session()->get('error'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1800,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: 'error',
        title: '{{ session()->get("error") }}'
    });
</script>
@endif

@if(session()->get('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1800,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "{{ session()->get('success') }}"
    });
</script>
@endif

@if($g_setting->tawk_live_chat_status == 'Show')
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/{{ $g_setting->tawk_live_chat_property_id }}/1fapclhaj';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
@endif
