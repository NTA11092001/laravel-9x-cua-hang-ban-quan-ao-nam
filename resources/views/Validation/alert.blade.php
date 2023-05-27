<script>
    function SwalText(position,icon,message){
        Swal.fire({
            position: position,
            icon: icon,
            text: message,
            showConfirmButton: false,
            toast: false,
            timer: 5000
        })
    }

    function SwalHtml(position,icon,message){
        Swal.fire({
            position: position,
            icon: icon,
            html: message,
            showConfirmButton: false,
            toast: false,
            timer: 5000
        })
    }

    @if (session('success'))
        SwalText('top-end','success','{{session('success')}}')
    @elseif(session('error'))
        SwalText('top-end','error','{{session('error')}}')
    @elseif(session('info'))
    SwalText('top-end','info','{{session('info')}}')
    @elseif ($errors->any())
        SwalHtml('top-end','info','<ul class="alert alert-primary text-start" style="list-style-type: disc !important;padding-left:100px;padding-right:100px">@foreach ($errors->all() as $error) <li>&#8226; {{ $error }}</li> @endforeach</ul>')
    @endif
</script>
