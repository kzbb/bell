<x-guest-layout>
    <div class="d-flex align-items-center justify-content-center" style="height: 80vh">
        <div id="call-btn" class="btn-stand-by" onclick="update();">
            <div class="h-100 d-flex align-items-center flex-column justify-content-center">
                <div class="h-50 d-flex align-items-end">
                    <div id="status" style="text-transform: capitalize"></div>
                </div>
                <div class="h-50">
                    <div id="bell_title" class="h-50 d-flex align-items-center flex-column justify-content-center"></div>
                    <div id="group_title" class="h-50 text-center"></div>
                </div>
            </div>
        </div>
    </div>

    <script> $(function () {
            get_one_bell();
        });</script>

</x-guest-layout>