<x-app-layout>
    <x-slot name="header">
        <a href="{{$bell->full_url}}" class="d-flex align-items-center justify-content-center my-3">
            {{$bell->full_url}}
        </a>
    </x-slot>

    <div>
        <div class="row justify-content-center my-5">
{{--            <div class="col"></div>--}}
            <div id="qrcode" class="col-auto card p-3 bg-white"></div>
{{--            <div class="col"></div>--}}
        </div>

        <div class="row justify-content-center">
{{--            <div class="col"></div>--}}
            <div class="col">
            <div class="m-5 text-center">
                <form action="{{ url('/store')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$bell->uid}}" name="uid">
                    @if(!empty($group))
                    <label for="titleInput" class="form-label"><a href="/group/edit/{{$group->uid}}" class="text-decoration-none">{{$group->title}}</a></label>
                    @endif
                    <input type="text" class="form-control text-center" id="titleInput" placeholder="{{$bell->title}}"
                           name="new_title" style="max-width: 24rem; margin-left: auto; margin-right: auto" autofocus>
                    <button class="btn btn-outline-primary btn-sm mt-3" type='submit'>RENAME</button>
                </form>
            </div>

            <div class="m-5 text-center">
                <form action="{{ url('/destroy')}}/{{$bell->uid}}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-danger" type='submit'>DELETE THIS BELL</button>
                </form>
            </div>
        </div>
{{--            <div class="col"></div>--}}
        </div>
    </div>

    <script src="/js/qrcodejs/qrcode.min.js"></script>
    <script type="text/javascript">
        var el = document.getElementById('qrcode');
        var text = '{{$bell['full_url']}}';
        new QRCode(el, text);
    </script>

</x-app-layout>