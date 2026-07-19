<div class="tab-pane fade" id="v-pills-cod" role="tabpanel"
aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{route('user.cod.payment')}}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link common_btn text-center w-100 border-0">Proceed</button>
                </form>
            </div>
        </div>
    </div>
</div>
