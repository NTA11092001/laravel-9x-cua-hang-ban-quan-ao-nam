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

    @if(session('some_error'))
    SwalText('top-end','error','{{session('some_error')}}')
    @elseif ($errors->any())
    SwalHtml('top-end','info','<ul class="alert alert-primary text-justify" style="padding-left:100px;padding-right:100px">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>')
    @elseif(session('notice_success'))
    SwalText('top-end','success','{{session('notice_success')}}')
    @endif
</script>
