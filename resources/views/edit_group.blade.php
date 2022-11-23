<x-app-layout>
    <x-slot name="header">
        <a href="{{$group->full_url}}" class="d-flex align-items-center justify-content-center my-3">
            {{$group->full_url}}
        </a>
    </x-slot>

    <div class="row">
        <div class="col-lg order-lg-2">
            <div id="bells" class="row my-3 justify-contents-center"></div>
        </div>
        <div class="col-lg-auto order-lg-1">
            <div class="row justify-content-center my-5">
                {{--                <div class="col"></div>--}}
                <div id="qrcode" class="col-auto card p-3 bg-white"></div>
                {{--                <div class="col"></div>--}}
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-auto">
                    <div class="m-5 text-center">
                        <form action="{{ url('/group/store')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$group->uid}}" name="uid">
                            {{--                    <label for="titleInput" class="form-label">BELL's Name</label>--}}
                            <input type="text" class="form-control text-center" id="titleInput"
                                   placeholder="{{$group->title}}"
                                   name="new_title" autofocus>
                            <button class="btn btn-outline-primary btn-sm mt-3" type='submit'>RENAME</button>
                        </form>
                    </div>

                    <div class="m-5 text-center">
                        <form action="{{ url('/group/destroy')}}/{{$group->uid}}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-danger" type='submit'>DELETE THIS GROUP</button>
                        </form>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>

    </div>

    <script src="/js/qrcodejs/qrcode.min.js"></script>
    <script type="text/javascript">
        var el = document.getElementById('qrcode');
        var text = '{{$group['full_url']}}';
        new QRCode(el, text);
    </script>

    <script> $(function () {
            get_bells('/group/members/{{$group->uid}}');
        });</script>

</x-app-layout>