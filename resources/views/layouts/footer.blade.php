        <div class="quick-alo-phone quick-alo-green quick-alo-show" id="quick-alo-phoneIcon"
            style="left: 0px; top: 80%;">
            <div class="popup" data-toggle="modal" data-target="#modal1">
                <div class="quick-alo-ph-circle"></div>
                <div class="quick-alo-ph-circle-fill"></div>
                <div class="quick-alo-ph-img-circle"
                    style="text-align: center;color: white;font-size: 80%;padding-top: 18px;">{{ __('layout.callStaff') }}</div>
            </div>
        </div>
        <form id="formCallEmployee" action="{{ route('call.employee') }}" method="post">
            @csrf
        </form>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('public/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('public/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('public/sbadmin2/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('public/js/js.js') }}"></script>
        </body>

        </html>
