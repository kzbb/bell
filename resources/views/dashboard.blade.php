<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-auto p-3">
                <form action="{{ url('/create')}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-outline-primary mt-3">
                        Add New BELL
                    </button>
                </form>
            </div>
            <div class="col-auto p-3">
                <form action="{{ url('/group/create')}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-outline-info mt-3">
                        Add New Group
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div id="bells" class="row my-3 justify-contents-center"></div>

    <div class="row my-3">
        @foreach($groups as $group)
            <div class="col-md-6">
                <div class="card m-3">
                    <div class="card-body">
                        <a href="/group/edit/{{$group->uid}}" class="text-decoration-none">
                            <h3 class="pt-1 px-2 bell-title">
                                {{$group->title}}
                            </h3>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script> $(function () {
            get_bells('/index');
        });</script>

</x-app-layout>
